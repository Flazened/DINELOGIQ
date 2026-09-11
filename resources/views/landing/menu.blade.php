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
        <img src="{{ asset('img/Background/Menu-Header-BG.png') }}" class="w-full">
        <div class="bg-[#F0EDE5] h-40 w-full flex justify-between px-20 items-center">
            <section class="bg-black w-40 h-20 rounded-[40px] flex justify-center items-center">
                <h1 class="text-white text-2xl font-black">Filter</h1>
            </section>
            <section class="h-18 w-280 border-3 border-black rounded-[200px] flex items-center justify-between">
                <input 
                class="text-black px-10 text-2xl focus:outline-none" 
                type="text" 
                placeholder="Search for ramen...">
                <img src="{{ asset('img/Icon/search.png') }}" 
                alt="search" 
                class=" mr-10 h-auto w-8">
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
                            <p class="text-white font-medium text-[25px] mr-20">Side Dish</p>
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

        <div class=" bg-[#201B1B] h-auto w-auto] py-20 px-5">

            <div class="flex justify-between px-10">
                <div class="ml-120">
                    <p class="text-[#F9FF43] text-8xl font-bold">Our Menu</p>
                </div>
                <div class="bg-[#004643] h-15 w-30 rounded-[40px] ">
                    <div class="flex mt-3 ml-5">
                        <img src="{{ asset('img/Icon/Cart.png') }}" class="h-8 w-auto flex ">
                        <p class="text-white -mt-2 text-[35px] font-bold px-4">0</p>
                    </div>
                </div>
            </div>
            <div class="mt-30">
                <p class="ml-15 text-5xl text-white">APPETIZERS - GOURMET BITES</p>
                <div class="flex justify-between flex-wrap px-5">
                    <section class=" bg-white h-130 w-100 rounded-[20px] mt-30 hover:scale-105 duration-300">
                        <a href="{{ route('detail') }}">
                        <img src="{{ asset('img/Food/Edamame.png') }}" class="h-90 w-90 ml-5 mt-5 object-cover rounded-2xl">
                        <div class="flex px-5 py-10 justify-between">
                            <p class="text-4xl font-bold">Edamame</p>
                            <img src="{{ asset('img/Icon/next.png') }}" class="h-8 w-auto">
                        </div>
                        </a>
                    </section>
                </div>
            </div>

            <div class="mt-30">
                <p class="ml-15 text-5xl text-white">MAIN COURSE- CHEF’S SIGNATURE</p>
                <div class="flex justify-between flex-wrap px-5">
                    <section class=" bg-white h-130 w-100 rounded-[20px] mt-30 hover:scale-105 duration-300">
                        <img src="{{ asset('img/Food/ShoyuRamen.png') }}" class="h-90 w-90 ml-5 mt-5 object-cover rounded-2xl">
                        <div class="flex px-5 py-10 justify-between">
                            <p class="text-4xl font-bold">Shoyu ramen</p>
                            <img src="{{ asset('img/Icon/next.png') }}" class="h-8 w-auto">
                        </div>
                    </section>
                </div>
            </div>

            <div class="mt-30">
                <p class="ml-15 text-5xl text-white">SIDE DISH - PERFECT PAIRING’S</p>
                <div class="flex justify-between flex-wrap px-5">
                    <section class=" bg-white h-130 w-100 rounded-[20px] mt-30 hover:scale-105 duration-300">
                        <img src="{{ asset('img/Food/MisoSoup.png') }}" class="h-90 w-90 ml-5 mt-5 object-cover rounded-2xl">
                        <div class="flex px-5 py-10 justify-between">
                            <p class="text-4xl font-bold">Miso soup</p>
                            <img src="{{ asset('img/Icon/next.png') }}" class="h-8 w-auto">
                        </div>
                    </section>
                </div>
            </div>

            <div class="mt-30">
                <p class="ml-15 text-5xl text-white">DESSERT - DIVINE ENDINGS</p>
                <div class="flex justify-between flex-wrap px-5">
                    <section class=" bg-white h-130 w-100 rounded-[20px] mt-30 hover:scale-105 duration-300">
                        <img src="{{ asset('img/Food/KakiGori.png') }}" class="h-90 w-90 ml-5 mt-5 object-cover rounded-2xl">
                        <div class="flex px-5 py-10 justify-between">
                            <p class="text-4xl font-bold">Kakigori</p>
                            <img src="{{ asset('img/Icon/next.png') }}" class="h-8 w-auto">
                        </div>
                    </section>
                </div>
            </div>

            <div class="mt-30">
                <p class="ml-15 text-5xl text-white">HOT DRINKS - WARMING INFUSIONS</p>
                <div class="flex justify-between flex-wrap px-5">
                    <section class=" bg-white h-130 w-100 rounded-[20px] mt-30 hover:scale-105 duration-300">
                        <img src="{{ asset('img/Food/HotOcha.png') }}" class="h-90 w-90 ml-5 mt-5 object-cover rounded-2xl">
                        <div class="flex px-5 py-10 justify-between">
                            <p class="text-4xl font-bold">Hot ocha</p>
                            <img src="{{ asset('img/Icon/next.png') }}" class="h-8 w-auto">
                        </div>
                    </section>
                </div>
            </div>

            <div class="mt-30">
                <p class="ml-15 text-5xl text-white">COLD DRINKS - CHILLED ELIXIRS</p>
                <div class="flex justify-between flex-wrap px-5">
                    <section class=" bg-white h-130 w-100 rounded-[20px] mt-30 hover:scale-105 duration-300">
                        <img src="{{ asset('img/Food/Genmaicha.png') }}" class="h-90 w-90 ml-5 mt-5 object-cover rounded-2xl">
                        <div class="flex px-5 py-10 justify-between">
                            <p class="text-4xl font-bold">Genmaicha</p>
                            <img src="{{ asset('img/Icon/next.png') }}" class="h-8 w-auto">
                        </div>
                    </section>
                </div>
            </div>



            

            




        </div>



        
        @include('partials.landing.footer')



    </body>
</html>