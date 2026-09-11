<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - LOCATION</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body>


        @include('partials.landing.header')
        <div class="bg-[#7F0017] w-full h-auto px-10 py-10">
            <div class="flex gap-5">
                <div class="bg-white h-100 w-800 rounded-4xl">
                    <div class="flex px-6 py-5 justify-between">
                        <p class="font-bold text-xl ml-20">Your Order</p>
                        <p class="font-bold text-xl mr-20">Total</p>
                    </div>
                    <hr class="mx-6">

                    {{-- Product --}}
                    <div class="bg-[#FAFAFA] flex justify-between mt-10">
                        <div class="flex">
                            <img src="{{ asset('img/Food/HokkaidoRamen.png')}}" class="h-50 w-50">
                                <div class="flex flex-col justify-between">
                                    <p class="mt-14 font-medium text-xl">Hokkaido Ramen</p>
                                    <div>
                                        <div class="inline-flex items-center border-2 border-[#D1DADD] rounded-2xl h-10 px-2 gap-0.5 mb-10">
                                            <button class="w-8 h-8 flex items-center justify-center text-lg font-medium hover:bg-gray-100 rounded-full">−</button>
                                            <div class="bg-[#D1DADD] h-5 w-[2px] rounded-2xl"></div>
                                            <span class="w-8 text-center text-lg font-semibold">1</span>
                                            <div class="bg-[#D1DADD] h-5 w-[2px] rounded-2xl"></div>
                                            <button class="w-8 h-8 flex items-center justify-center text-lg font-medium hover:bg-gray-100 rounded-full">+</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <div class="flex gap-5 px-6 items-center">
                                <p>Rp57.000</p>
                                <button>
                                    <img src="{{ asset('img/Icon/delete.png') }}" class="w-10 h-10">
                                </button>
                            </div>
                    </div>
                </div>

                <div class="bg-white h-150 w-320 rounded-4xl">
                    <p class="flex justify-center py-5 text-2xl font-bold">Order Summary<p>
                    <div class="flex justify-between">
                        <input type="text" 
                               name="discount" 
                               placeholder="  Discount Voucher"
                               class="ml-8 w-50 border-1 border-black rounded-4xl h-10 focus:outline-none focus:border-blue-500">
                        <button class="font-bold h-10 w-25 border-1 text-[#677A7E] border-black mr-8 rounded-3xl">
                            Apply
                        </button>
                    </div>

                            <div class="flex flex-col">
                                <div class="py-3 mt-5 flex justify-between px-10">
                                    <p class="text-[#677A7E]">Subtotal:</p>
                                    <p class="text-[#677A7E]">Rp57.000</p>
                                </div>
                                <div class="py-3 flex justify-between px-10">
                                    <p class="text-[#677A7E]">Delivery:</p>
                                    <p class="text-[#677A7E]">Rp4.000</p>
                                </div>
                                <div class="py-3 flex justify-between px-10">
                                    <p class="text-[#677A7E]">Tax:</p>
                                    <p class="text-[#677A7E]">Rp1.500</p>
                                </div>
                                <div class="py-3 flex justify-between px-10">
                                    <p class="font-bold text-xl">Total:</p>
                                    <p class="font-bold text-xl">Rp62.500</p>
                                </div>
                            </div>
                        <div class="flex px-10 mt-30">
                            <img src="">
                            <p>On-Time Delivery Guarantee or 100% Compensation! <b>Details</b></p>
                        </div>
                        <button class="bg-[#7F0017] text-white font-bold text-xl mt-5 h-13 rounded-4xl w-80 ml-10 mb-5 hover:bg-amber-900 duration-300">
                            Checkout
                        </button>

                </div>

            </div>

        </div>


        
        @include('partials.landing.footer')



    </body>
</html>