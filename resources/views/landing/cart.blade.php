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
                    <div class="bg-[#FAFAFA] flex mt-10">
                        <img src="{{ asset('img/Food/HokkaidoRamen.png')}}" class="h-50 w-50">
                        <div class="flex flex-col justify-between">
                            <p>Hokkaido Ramen</p>
                            <div class="inline-flex items-center border-2 border-[#D1DADD] rounded-2xl h-10 px-2">
                                <button class="w-8 h-8 flex items-center justify-center text-lg font-medium hover:bg-gray-100 rounded-full">−</button>
                                <span class="w-8 text-center text-lg font-semibold">1</span>
                                <button class="w-8 h-8 flex items-center justify-center text-lg font-medium hover:bg-gray-100 rounded-full">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white h-150 w-320 rounded-4xl">

                </div>

            </div>

        </div>


        
        @include('partials.landing.footer')



    </body>
</html>