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
        <img src="{{ asset('img/Background/Menu-Header-BG.png') }}"
             class="-mt-40 relative z-0 justify-centerd w-full bg-cover bg-center bg-no-repeat flex items-center">
        <div class="bg-[#F0EDE5] h-40 w-full flex justify-between px-20 items-center">
            <section class="bg-black w-40 h-20 rounded-[40px] flex justify-center items-center">
                <h1 class="text-white text-2xl font-black">Filter</h1>
            </section>
            <section class="h-18 w-280 border-3 border-black rounded-[200px] flex items-center justify-between">
                <input class="text-black px-10 text-2xl" type="text" placeholder="Search for ramen...">
                <img src="{{ asset('img/Icon/search.png') }}" alt="search" class="mr-10 h-auto w-8">
            </section>
        </div>

        <div class="bg-black w-full h-[1px]"></div>

        <div class="bg-[#F0EDE5] h-100 w-full">
            <p class="text-black flex justify-center py-10 text-4xl font-medium">Find Dishes - Discover Our Menu</p>
                <div class="flex justify-center">
                    <div class="grid grid-cols-3 gap-12 -ml-20">

                        <section class="flex justify-between items-center px-4 rounded-[38px] ml-25 mr-5 bg-[#004643] border-5 border-[#667080] h-20 w-80">
                            <img src="{{ asset('img/Food/Menu-1.png') }}" class="h-10 w-auto">
                            <p class="text-white font-medium text-[25px] mr-10">Appetizer</p>
                        </section>

                        <section class="flex justify-between items-center px-4 rounded-[38px] ml-25 mr-5 bg-[#004643] border-5 border-[#667080] h-20 w-80">
                            <img src="{{ asset('img/Food/Menu-2.png') }}" class="h-20 w-auto">
                            <p class="text-white font-medium text-[25px] mr-7">Main Course</p>
                        </section>

                        <section class="flex justify-between items-center px-4 rounded-[38px] ml-25 mr-5 bg-[#004643] border-5 border-[#667080] h-20 w-80">
                            <img src="{{ asset('img/Food/Menu-3.png') }}" class="h-20 w-auto">
                            <p class="text-white font-medium text-[25px] mr-20s">Side Dish</p>
                        </section>

                        <section class="flex justify-between items-center px-4 rounded-[38px] ml-25 mr-5 bg-[#004643] border-5 border-[#667080] h-20 w-80">
                            <img src="{{ asset('img/Food/Menu-4.png') }}" class="h-16 w-auto">
                            <p class="text-white font-medium text-[25px] mr-15">Dessert</p>
                        </section>

                        <section class="flex justify-between items-center px-4 rounded-[38px] ml-25 mr-5 bg-[#004643] border-5 border-[#667080] h-20 w-80">
                            <img src="{{ asset('img/Food/Menu-5.png') }}" class="h-20 mt-4 w-auto">
                            <p class="text-white font-medium text-[25px] mr-12">Hot drinks</p>
                        </section>

                        <section class="flex justify-between items-center px-4 rounded-[38px] ml-25 mr-5 bg-[#004643] border-5 border-[#667080] h-20 w-80">
                            <img src="{{ asset('img/Food/Menu-6.png') }}" class="h-15 w-auto">
                            <p class="text-white font-medium text-[25px] mr-15">Cold Drinks</p>
                        </section>
                    
                    </div>
                </div>
        </div>

        <div class=" bg-[#201B1B] h-200 w-auto]">

        </div>



        
        @include('partials.landing.footer')



    </body>
</html>