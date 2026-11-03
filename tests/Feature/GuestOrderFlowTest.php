<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestOrderFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\MenuSeeder::class);
    }

    public function test_guest_can_view_menu_page_with_seeded_items(): void
    {
        $response = $this->get(route('menu'));
        $response->assertStatus(200);
        $response->assertSee('Shoyu ramen');
        $response->assertSee('Edamame');
        $response->assertSee('Kakigori');
    }

    public function test_guest_can_view_menu_detail(): void
    {
        $item = MenuItem::first();
        $response = $this->get(route('menu.show', $item->id));
        $response->assertStatus(200);
        $response->assertSee($item->name);
    }

    public function test_guest_can_add_item_to_cart(): void
    {
        $item = MenuItem::where('name', 'Shoyu ramen')->first();

        $response = $this->post(route('cart.add'), [
            'menu_id' => $item->id,
            'quantity' => 2,
            'notes' => 'Extra nori please',
        ]);

        $response->assertRedirect(route('cart'));
        $this->assertEquals(2, session('cart')[$item->id]['quantity']);
    }

    public function test_guest_can_update_cart_quantity_and_remove_item(): void
    {
        $item = MenuItem::first();

        // Add to cart
        $this->post(route('cart.add'), [
            'menu_id' => $item->id,
            'quantity' => 1,
        ]);

        // Update quantity
        $response = $this->put(route('cart.update'), [
            'menu_id' => $item->id,
            'quantity' => 3,
        ]);
        $response->assertRedirect(route('cart'));
        $this->assertEquals(3, session('cart')[$item->id]['quantity']);

        // Remove item
        $response = $this->delete(route('cart.remove', $item->id));
        $response->assertRedirect(route('cart'));
        $this->assertArrayNotHasKey($item->id, session('cart', []));
    }

    public function test_guest_can_checkout_and_order_is_saved_in_database(): void
    {
        $ramen = MenuItem::where('name', 'Shoyu ramen')->first();
        $edamame = MenuItem::where('name', 'Edamame')->first();

        // Put items in cart
        session([
            'cart' => [
                $ramen->id => ['quantity' => 2, 'notes' => 'Tidak pedas'],
                $edamame->id => ['quantity' => 1, 'notes' => 'Garam sedikit'],
            ],
        ]);

        $expectedTotal = ($ramen->price * 2) + ($edamame->price * 1);

        $response = $this->post(route('order.store'), [
            'customer_name' => 'Budi Pratama',
            'customer_phone' => '081234567890',
            'table_number' => 7,
            'payment_method' => 'qris',
            'notes' => 'Tolong sediakan sendok tambahan',
        ]);

        // Pastikan order tersimpan di DB
        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Budi Pratama',
            'customer_phone' => '081234567890',
            'table_number' => 7,
            'total_amount' => $expectedTotal,
            'payment_method' => 'qris',
            'status' => 'pending',
        ]);

        $order = Order::where('customer_name', 'Budi Pratama')->first();

        // Pastikan redirect ke order.success
        $response->assertRedirect(route('order.success', $order->id));

        // Pastikan order items tersimpan dengan snapshot harga yang benar
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'menu_item_id' => $ramen->id,
            'menu_item_name' => $ramen->name,
            'menu_item_price' => $ramen->price,
            'quantity' => 2,
            'subtotal' => $ramen->price * 2,
        ]);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'menu_item_id' => $edamame->id,
            'quantity' => 1,
            'subtotal' => $edamame->price,
        ]);

        // Pastikan keranjang dikosongkan setelah order sukses
        $this->assertNull(session('cart'));
    }

    public function test_guest_can_track_order_by_order_number(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-TEST-123456',
            'customer_name' => 'Siti Aisyah',
            'customer_phone' => '08987654321',
            'table_number' => 3,
            'payment_method' => 'cash',
            'total_amount' => 55000,
            'status' => 'processing',
        ]);

        $response = $this->get(route('order.track', ['order_number' => 'ORD-TEST-123456']));
        $response->assertStatus(200);
        $response->assertSee('ORD-TEST-123456');
        $response->assertSee('Siti Aisyah');
    }

    public function test_admin_dashboard_displays_correct_stats(): void
    {
        Order::create([
            'order_number' => 'ORD-ADM-1',
            'customer_name' => 'Customer 1',
            'customer_phone' => '0811111111',
            'table_number' => 1,
            'payment_method' => 'cash',
            'total_amount' => 100000,
            'status' => 'completed',
        ]);

        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('TOTAL MENU');
        $response->assertSee('ACTIVE ORDERS');
    }

    public function test_admin_can_crud_menu_item(): void
    {
        $category = Category::first();

        // 1. Create Menu Item
        $response = $this->post(route('admin.menu-controller.store'), [
            'name' => 'Spicy Ramen Baru',
            'price' => 60000,
            'category' => $category->name,
            'status' => 'available',
            'description' => 'Pedas nikmat',
            'image' => 'ShoyuRamen.png',
        ]);
        $response->assertRedirect(route('admin.menu'));
        $this->assertDatabaseHas('menu_items', ['name' => 'Spicy Ramen Baru', 'price' => 60000]);

        $menu = MenuItem::where('name', 'Spicy Ramen Baru')->first();

        // 2. Toggle Status
        $this->patch(route('admin.menu.toggle.controller', $menu->id));
        $this->assertEquals('unavailable', $menu->fresh()->status);

        // 3. Update Menu Item
        $this->put("/admin/menu-controller/{$menu->id}", [
            'name' => 'Spicy Ramen Super',
            'price' => 65000,
            'category' => $category->name,
            'status' => 'available',
        ]);
        $this->assertDatabaseHas('menu_items', ['name' => 'Spicy Ramen Super', 'price' => 65000]);

        // 4. Delete Menu Item
        $this->delete("/admin/menu-controller/{$menu->id}");
        $this->assertDatabaseMissing('menu_items', ['id' => $menu->id]);
    }

    public function test_admin_can_update_order_status(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-STAT-001',
            'customer_name' => 'Test Customer',
            'customer_phone' => '0812345678',
            'table_number' => 2,
            'payment_method' => 'cash',
            'total_amount' => 50000,
            'status' => 'pending',
        ]);

        $response = $this->patch(route('admin.order.status.controller', $order->id), [
            'status' => 'completed',
        ]);

        $this->assertEquals('completed', $order->fresh()->status);
    }
}
