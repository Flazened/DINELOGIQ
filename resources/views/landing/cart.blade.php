<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('partials.landing.header')
    
    <div class="bg-[#7F0017] w-full h-auto px-10 py-10">
        <div class="flex gap-5">
            <!-- Cart Section -->
            <div class="bg-white h-auto w-2/3 rounded-4xl p-6">
                <div class="flex px-6 py-5 justify-between">
                    <p class="font-bold text-xl">Your Order</p>
                    <p class="font-bold text-xl">Total</p>
                </div>
                <hr class="mx-6">

                {{-- Product --}}
                <div class="bg-[#FAFAFA] flex justify-between mt-10 p-4 rounded-2xl">
                    <div class="flex">
                        <img src="{{ asset('img/Food/HokkaidoRamen.png')}}" class="h-32 w-32 object-cover rounded-xl">
                        <div class="flex flex-col justify-between ml-4">
                            <p class="font-medium text-xl mt-8">Hokkaido Ramen</p>
                            <div class="inline-flex items-center border-2 border-[#D1DADD] rounded-2xl h-10 px-2 gap-0.5">
                                <button onclick="decreaseQty()" class="w-8 h-8 flex items-center justify-center text-lg font-medium hover:bg-gray-100 rounded-full">−</button>
                                <div class="bg-[#D1DADD] h-5 w-[2px] rounded-2xl"></div>
                                <span id="qtyDisplay" class="w-8 text-center text-lg font-semibold">1</span>
                                <div class="bg-[#D1DADD] h-5 w-[2px] rounded-2xl"></div>
                                <button onclick="increaseQty()" class="w-8 h-8 flex items-center justify-center text-lg font-medium hover:bg-gray-100 rounded-full">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-5 px-6 items-center">
                        <p id="productPrice" class="font-semibold text-lg">Rp 57.000</p>
                        <button onclick="deleteProduct()">
                            <img src="{{ asset('img/Icon/delete.png') }}" class="w-8 h-8 hover:opacity-70">
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="bg-white h-auto w-1/3 rounded-4xl p-6">
                <p class="flex justify-center py-5 text-2xl font-bold">Order Summary</p>
                
                <div class="flex justify-between mt-4">
                    <input type="text" 
                           name="discount" 
                           placeholder="Discount Voucher"
                           class="w-2/3 border border-gray-300 rounded-2xl h-10 px-4 focus:outline-none focus:border-[#7F0017]">
                    <button onclick="applyDiscount()" class="font-bold h-10 w-1/3 border border-gray-300 text-[#677A7E] rounded-2xl hover:bg-gray-100">
                        Apply
                    </button>
                </div>

                <div class="flex flex-col mt-6">
                    <div class="py-3 flex justify-between px-4">
                        <p class="text-[#677A7E]">Subtotal:</p>
                        <p id="subtotalPrice" class="text-[#677A7E]">Rp 57.000</p>
                    </div>
                    <div class="py-3 flex justify-between px-4">
                        <p class="text-[#677A7E]">Delivery:</p>
                        <p id="deliveryPrice" class="text-[#677A7E]">Rp 7.500</p>
                    </div>
                    <div class="py-3 flex justify-between px-4">
                        <p class="text-[#677A7E]">Tax:</p>
                        <p id="taxPrice" class="text-[#677A7E]">Rp 12.000</p>
                    </div>
                    <hr class="my-2">
                    <div class="py-3 flex justify-between px-4">
                        <p class="font-bold text-xl">Total:</p>
                        <p id="totalPrice" class="font-bold text-xl text-[#7F0017]">Rp 76.500</p>
                    </div>
                </div>

                <div class="flex flex-col items-center mt-8">
                    <div class="flex px-4 gap-2 items-center">
                        <img src="{{ asset('img/Icon/Protect.png') }}" class="h-8 w-8">
                        <p class="text-sm text-[#677A7E]">On-Time Delivery Guarantee or 100% Compensation! <b class="text-[#7F0017]">Details</b></p>
                    </div>
                    
                    <button onclick="openOrderSummary()" 
                            class="bg-[#7F0017] text-white font-bold text-xl mt-6 h-14 rounded-4xl w-full hover:bg-amber-900 duration-300 shadow-lg">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Summary Pop-Up (Konfirmasi Pesanan) -->
    <div id="orderSummaryModal" class="hidden fixed inset-0 bg-black/50 z-50 overflow-y-auto">
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl relative p-8">
                
                <!-- Back Button -->
                <button onclick="closeOrderSummary()" class="absolute top-4 left-4">
                    <div class="bg-[#7F0017] rounded-xl p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                </button>

                <h2 class="text-2xl font-bold text-center mb-8 mt-4">Order Summary</h2>
                
                <!-- Product Item -->
                <div class="flex items-center gap-4 mb-8">
                    <img src="{{ asset('img/Food/HokkaidoRamen.png') }}" class="w-24 h-24 rounded-2xl object-cover">
                    <div class="flex-1">
                        <p class="font-medium text-lg mb-3">Hokkaido Ramen</p>
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center border border-gray-300 rounded-lg bg-white">
                                <button onclick="decreaseQty()" class="w-8 h-8 flex items-center justify-center text-sm hover:bg-gray-100 rounded-l-lg">−</button>
                                <span id="summaryQty" class="w-10 text-center text-sm font-semibold border-x border-gray-300 py-1">1</span>
                                <button onclick="increaseQty()" class="w-8 h-8 flex items-center justify-center text-sm hover:bg-gray-100 rounded-r-lg">+</button>
                            </div>
                            <p id="summaryPrice" class="font-semibold">Rp 57.000</p>
                        </div>
                    </div>
                </div>

                <!-- Price Details -->
                <hr class="my-6">
                <div class="space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal:</span>
                        <span id="summarySubtotal" class="text-gray-600">Rp 57.000</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Delivery:</span>
                        <span id="summaryDelivery" class="text-gray-600">Rp 7.500</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Tax:</span>
                        <span id="summaryTax" class="text-gray-600">Rp 12.000</span>
                    </div>
                    <div class="border-t border-gray-300 pt-3 mt-3">
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total:</span>
                            <span id="summaryTotal" class="text-[#7F0017]">Rp 76.500</span>
                        </div>
                    </div>
                </div>

                <!-- Confirmation Button -->
                <button onclick="goToCheckout1()" class="w-full bg-[#7F0017] text-white font-bold text-lg py-4 rounded-2xl mt-8 hover:bg-amber-900 duration-300 shadow-lg">
                    Confirmation
                </button>
            </div>
        </div>
    </div>

    <!-- Checkout Modal (3 Steps) -->
    <div id="checkoutModal" class="hidden fixed inset-0 bg-black/50 z-50 overflow-y-auto">
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl w-full max-w-6xl shadow-2xl my-8 relative">
                
                <!-- Close Button -->
                <button onclick="closeCheckout()" class="absolute top-4 left-4 z-10">
                    <img src="{{ asset('img/Icon/back.png') }}" alt="Back" class="h-10 w-10 hover:opacity-70">
                </button>

                <div class="flex flex-col lg:flex-row">
                    <!-- Left Side - Form -->
                    <div class="flex-1 p-10" id="checkoutFormContainer">
                        <!-- Progress Steps -->
                        <div class="flex items-center justify-center mb-10">
                            <div class="flex items-center">
                                <div id="step1Icon" class="w-10 h-10 rounded-full bg-[#7F0017] text-white flex items-center justify-center font-bold transition-all duration-300">
                                    <img src="{{ asset('img/Icon/Location-checkout.png') }}" class="w-5 h-5">
                                </div>
                                <div id="line1" class="w-32 h-1 bg-gray-300 mx-2 transition-all duration-300"></div>
                                <div id="step2Icon" class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300">
                                    <img src="{{ asset('img/Icon/E-Money.png') }}" class="w-5 h-5">
                                </div>
                                <div id="line2" class="w-32 h-1 bg-gray-300 mx-2 transition-all duration-300"></div>
                                <div id="step3Icon" class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300">
                                    <img src="{{ asset('img/Icon/Done-checkout.png') }}" class="w-5 h-5">
                                </div>
                            </div>
                        </div>

                        <!-- Step 1: Personal Information -->
                        <div id="step1" class="checkout-step">
                            <h2 class="text-3xl font-bold mb-8">Checkout</h2>

                            <!-- Personal Information -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold mb-4">Personal information:</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">First Name</label>
                                        <input type="text" id="firstName" placeholder="First Name" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-[#7F0017]">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Last Name</label>
                                        <input type="text" id="lastName" placeholder="Last Name" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-[#7F0017]">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Phone Number</label>
                                        <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden focus-within:border-[#7F0017]">
                                            <div class="flex items-center px-3 bg-gray-50 border-r border-gray-300">
                                                <img src="{{ asset('img/Icon/Indonesia.png') }}" class="w-5 h-5 mr-2">
                                                <span class="text-gray-700">+62</span>
                                            </div>
                                            <input type="tel" id="phoneNumber" placeholder="813-1234-5678" class="w-full px-4 py-3 focus:outline-none">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                                        <div class="relative">
                                            <img src="{{ asset('img/Icon/Email.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5">
                                            <input type="email" id="email" placeholder="your@email.com" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:border-[#7F0017]">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delivery Details -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold mb-4">Delivery details:</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">City</label>
                                        <div class="relative">
                                            <select id="city" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-[#7F0017] appearance-none bg-white">
                                                <option value="">Pontianak, Indonesia</option>
                                                <option value="jakarta">Jakarta, Indonesia</option>
                                                <option value="surabaya">Surabaya, Indonesia</option>
                                                <option value="bandung">Bandung, Indonesia</option>
                                            </select>
                                            <img src="{{ asset('img/Icon/Location-checkout.png') }}" class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 pointer-events-none">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Address</label>
                                        <input type="text" id="address" placeholder="Jalan Gajahmada 10 No.15" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-[#7F0017]">
                                    </div>
                                </div>
                            </div>

                            <button onclick="goToStep2()" class="w-full bg-[#7F0017] text-white font-bold text-xl py-4 rounded-2xl hover:bg-amber-900 duration-300 shadow-lg">
                                Next
                            </button>
                        </div>

                        <!-- Step 2: Payment -->
                        <div id="step2" class="checkout-step hidden">
                            <h2 class="text-3xl font-bold mb-8">Payment</h2>
                            
                            <!-- Payment Methods -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold mb-4">Select Payment Method:</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="border-2 border-gray-200 rounded-xl p-4 cursor-pointer hover:border-[#7F0017] transition-all payment-option">
                                        <input type="radio" name="payment" value="e-money" class="hidden" onchange="selectPayment(this)">
                                        <div class="flex items-center justify-center">
                                            <img src="{{ asset('img/Icon/E-Money.png') }}" class="h-12 w-auto">
                                        </div>
                                    </label>
                                    <label class="border-2 border-gray-200 rounded-xl p-4 cursor-pointer hover:border-[#7F0017] transition-all payment-option">
                                        <input type="radio" name="payment" value="visa" class="hidden" onchange="selectPayment(this)">
                                        <div class="flex items-center justify-center">
                                            <img src="{{ asset('img/Icon/VisaCard.png') }}" class="h-12 w-auto">
                                        </div>
                                    </label>
                                    <label class="border-2 border-gray-200 rounded-xl p-4 cursor-pointer hover:border-[#7F0017] transition-all payment-option">
                                        <input type="radio" name="payment" value="bca" class="hidden" onchange="selectPayment(this)">
                                        <div class="flex items-center justify-center">
                                            <img src="{{ asset('img/Icon/Bca.png') }}" class="h-12 w-auto">
                                        </div>
                                    </label>
                                    <label class="border-2 border-gray-200 rounded-xl p-4 cursor-pointer hover:border-[#7F0017] transition-all payment-option">
                                        <input type="radio" name="payment" value="dana" class="hidden" onchange="selectPayment(this)">
                                        <div class="flex items-center justify-center">
                                            <img src="{{ asset('img/Icon/Dana.png') }}" class="h-12 w-auto">
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Billing Address Checkbox -->
                            <div class="mb-8">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" id="sameAddress" checked class="w-5 h-5 rounded border-gray-300 text-[#7F0017] focus:ring-[#7F0017]">
                                    <span class="ml-2 text-gray-700">Billing address is the same as shipping address.</span>
                                </label>
                            </div>

                            <!-- Illustration -->
                            <div class="flex justify-center mb-8">
                                <img src="{{ asset('img/Logo/Logo-Pure.png') }}" alt="Order in way" class="h-64 w-auto">
                            </div>

                            <div class="flex gap-4">
                                <button onclick="goToStep1()" class="w-1/3 bg-gray-200 text-gray-700 font-bold text-xl py-4 rounded-2xl hover:bg-gray-300 duration-300">
                                    Back
                                </button>
                                <button onclick="goToStep3()" class="w-2/3 bg-[#7F0017] text-white font-bold text-xl py-4 rounded-2xl hover:bg-amber-900 duration-300 shadow-lg">
                                    Purchase
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Success -->
                        <div id="step3" class="checkout-step hidden">
                            <div class="flex flex-col items-center justify-center py-10">
                                <img src="{{ asset('img/Background/Orderinway.png') }}" alt="Delivery" class="h-80 w-auto mb-8">
                                <h2 class="text-3xl font-bold text-center mb-4">Thank you! Your order is on the way.</h2>
                                <p class="text-gray-600 text-center mb-8">We'll send you a confirmation email shortly.</p>
                                
                                <div class="flex gap-4">
                                    <button onclick="closeCheckout()" class="bg-gray-200 text-gray-700 font-bold text-lg py-3 px-8 rounded-2xl hover:bg-gray-300 duration-300">
                                        Back to Home
                                    </button>
                                    <button onclick="trackOrder()" class="bg-[#7F0017] text-white font-bold text-lg py-3 px-8 rounded-2xl hover:bg-amber-900 duration-300 shadow-lg">
                                        Track Your Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Order Summary -->
                    <div class="w-full lg:w-96 bg-gray-50 rounded-b-3xl lg:rounded-r-3xl lg:rounded-bl-none p-8" id="orderSummaryPanel">
                        <h3 class="text-xl font-bold mb-6">Order Summary</h3>
                        
                        <!-- Product Item -->
                        <div class="flex gap-4 mb-6 pb-6 border-b border-gray-200">
                            <img src="{{ asset('img/Food/HokkaidoRamen.png') }}" class="w-20 h-20 rounded-xl object-cover">
                            <div class="flex-1">
                                <p class="font-medium text-sm mb-2">Hokkaido Ramen</p>
                                <div class="flex items-center justify-between">
                                    <div class="inline-flex items-center border border-gray-300 rounded-lg">
                                        <button onclick="decreaseQty()" class="w-7 h-7 flex items-center justify-center text-sm hover:bg-gray-100 rounded-l-lg">−</button>
                                        <span id="modalQty" class="w-8 text-center text-sm font-semibold">1</span>
                                        <button onclick="increaseQty()" class="w-7 h-7 flex items-center justify-center text-sm hover:bg-gray-100 rounded-r-lg">+</button>
                                    </div>
                                    <p id="modalProductPrice" class="font-semibold">Rp 57.000</p>
                                </div>
                            </div>
                            <button onclick="deleteProduct()">
                                <img src="{{ asset('img/Icon/delete.png') }}" class="w-5 h-5">
                            </button>
                        </div>

                        <!-- Price Details -->
                        <div class="space-y-3">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal:</span>
                                <span id="modalSubtotal">Rp 57.000</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Delivery:</span>
                                <span id="modalDelivery">Rp 7.500</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax:</span>
                                <span id="modalTax">Rp 12.000</span>
                            </div>
                            <div class="border-t border-gray-300 pt-3 mt-3">
                                <div class="flex justify-between font-bold text-lg">
                                    <span>Total:</span>
                                    <span id="modalTotal" class="text-[#7F0017]">Rp 76.500</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // State management
        let currentStep = 1;
        let quantity = 1;
        const basePrice = 57000;
        const deliveryPrice = 7500;
        const taxPrice = 12000;

        // Format rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Calculate total
        function calculateTotal() {
            const subtotal = basePrice * quantity;
            const total = subtotal + deliveryPrice + taxPrice;
            
            // Update main page
            document.getElementById('qtyDisplay').textContent = quantity;
            document.getElementById('productPrice').textContent = formatRupiah(subtotal);
            document.getElementById('subtotalPrice').textContent = formatRupiah(subtotal);
            document.getElementById('totalPrice').textContent = formatRupiah(total);
            
            // Update order summary modal
            document.getElementById('summaryQty').textContent = quantity;
            document.getElementById('summaryPrice').textContent = formatRupiah(subtotal);
            document.getElementById('summarySubtotal').textContent = formatRupiah(subtotal);
            document.getElementById('summaryTotal').textContent = formatRupiah(total);
            
            // Update checkout modal
            document.getElementById('modalQty').textContent = quantity;
            document.getElementById('modalProductPrice').textContent = formatRupiah(subtotal);
            document.getElementById('modalSubtotal').textContent = formatRupiah(subtotal);
            document.getElementById('modalTotal').textContent = formatRupiah(total);
        }

        // Quantity functions
        function increaseQty() {
            quantity++;
            calculateTotal();
        }

        function decreaseQty() {
            if (quantity > 1) {
                quantity--;
                calculateTotal();
            }
        }

        // Delete product
        function deleteProduct() {
            if (confirm('Are you sure you want to remove this item?')) {
                closeOrderSummary();
                closeCheckout();
                alert('Product removed from cart');
            }
        }

        // Apply discount
        function applyDiscount() {
            const discountInput = document.querySelector('input[name="discount"]');
            if (discountInput.value.trim()) {
                alert('Discount code applied!');
                discountInput.value = '';
            } else {
                alert('Please enter a discount code');
            }
        }

        // Order Summary Modal functions
        function openOrderSummary() {
            document.getElementById('orderSummaryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            calculateTotal();
        }

        function closeOrderSummary() {
            document.getElementById('orderSummaryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Checkout Modal functions
        function goToCheckout1() {
            closeOrderSummary();
            document.getElementById('checkoutModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            currentStep = 1;
            showStep(1);
        }

        function closeCheckout() {
            document.getElementById('checkoutModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Step navigation
        function showStep(step) {
            // Hide all steps
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step3').classList.add('hidden');
            
            // Show current step
            document.getElementById('step' + step).classList.remove('hidden');
            
            // Update progress indicators
            updateProgress(step);
            
            // Hide Order Summary panel on step 3
            const orderSummaryPanel = document.getElementById('orderSummaryPanel');
            const checkoutFormContainer = document.getElementById('checkoutFormContainer');
            
            if (step === 3) {
                orderSummaryPanel.classList.add('hidden');
                checkoutFormContainer.classList.remove('lg:flex-1');
                checkoutFormContainer.classList.add('w-full');
            } else {
                orderSummaryPanel.classList.remove('hidden');
                checkoutFormContainer.classList.remove('w-full');
                checkoutFormContainer.classList.add('lg:flex-1');
            }
            
            currentStep = step;
        }

        function updateProgress(step) {
            // Reset all
            document.getElementById('step1Icon').className = 'w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300';
            document.getElementById('step2Icon').className = 'w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300';
            document.getElementById('step3Icon').className = 'w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300';
            document.getElementById('line1').className = 'w-32 h-1 bg-gray-300 mx-2 transition-all duration-300';
            document.getElementById('line2').className = 'w-32 h-1 bg-gray-300 mx-2 transition-all duration-300';
            
            if (step >= 1) {
                document.getElementById('step1Icon').className = 'w-10 h-10 rounded-full bg-[#7F0017] text-white flex items-center justify-center font-bold transition-all duration-300';
            }
            if (step >= 2) {
                document.getElementById('step2Icon').className = 'w-10 h-10 rounded-full bg-[#7F0017] text-white flex items-center justify-center font-bold transition-all duration-300';
                document.getElementById('line1').className = 'w-32 h-1 bg-[#7F0017] mx-2 transition-all duration-300';
            }
            if (step >= 3) {
                document.getElementById('step3Icon').className = 'w-10 h-10 rounded-full bg-[#7F0017] text-white flex items-center justify-center font-bold transition-all duration-300';
                document.getElementById('line2').className = 'w-32 h-1 bg-[#7F0017] mx-2 transition-all duration-300';
            }
        }

        function goToStep2() {
            // Validation
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const phoneNumber = document.getElementById('phoneNumber').value;
            const email = document.getElementById('email').value;
            const city = document.getElementById('city').value;
            const address = document.getElementById('address').value;
            
            if (!firstName || !lastName || !phoneNumber || !email || !address) {
                alert('Please fill in all required fields');
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return;
            }
            
            showStep(2);
        }

        function goToStep1() {
            showStep(1);
        }

        function selectPayment(radio) {
            // Remove active class from all options
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('border-[#7F0017]', 'bg-red-50');
                option.classList.add('border-gray-200');
            });
            
            // Add active class to selected option
            radio.closest('.payment-option').classList.remove('border-gray-200');
            radio.closest('.payment-option').classList.add('border-[#7F0017]', 'bg-red-50');
        }

        function goToStep3() {
            // Check if payment method is selected
            const paymentSelected = document.querySelector('input[name="payment"]:checked');
            if (!paymentSelected) {
                alert('Please select a payment method');
                return;
            }
            
            // Show success step
            showStep(3);
        }

        function trackOrder() {
            alert('Order tracking feature coming soon!');
        }

        // Close modals when clicking outside
        document.getElementById('orderSummaryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderSummary();
            }
        });

        document.getElementById('checkoutModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCheckout();
            }
        });

        // Initialize
        calculateTotal();
    </script>

    @include('partials.landing.footer')

</body>
</html>