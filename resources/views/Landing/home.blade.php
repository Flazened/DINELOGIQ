<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - HOME</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
    <body>
        @include('partials.header')
        <div class="relative z-10 h-[145vh] w-full"></div>
        <!-- Tambahkan class relative dan z-10 agar naik ke atas background -->
        <div class="relative z-10 -ml-20">
            <img src="{{ asset('img/Logo/LogoWithName.png') }}" class="scale-40">
            <p class="text-yellow-300 font-bold ml-60 -mt-15 mb-10 text-6xl">Enjoy the true<br>Japanese ramen soup</p>
            <p class="text-white ml-60 text-3xl">Our soup distributed directly from Japan and <br>we guarantee you the best quality from it.</p>
            <div class="ml-280 flex flex-row -mt-100">
                <img src="{{ asset('img/Food/FoodOrang.png') }}" class="h-auto w-80 ml-10">
                <img src="{{ asset('img/Food/Ramen-Wangy.png') }}" class="h-auto w-80 ml-10">
            </div>        
        </div>

        <div class="relative z-10 h-[5vh] w-full"></div>
        <div>
            <img src="{{ asset('img/Background/Background-Home-2.png') }}" class="absolute scale-100 min-h-screen object-fit ">
            <div class="relative z-10 pt-[22vw] sm:pt-[19vw] md:pt-[16vw] lg:pt-[14vw] pb-16 px-6 md:px-12 lg:px-20 max-w-78l  mx-auto">
                <div class="mt-40 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    
                    <!-- COMBO 1 -->
                    <div class="bg-[#f1f0dc] rounded-3xl p-12 md:p-16 flex flex-row items-center justify-between shadow-lg">
                        <div class="flex flex-col justify-between h-full space-y-2">
                            <div>
                                <h3 class="text-[#c50c11] font-extrabold text-3xl md:text-4xl tracking-tight uppercase">COMBO 1</h3>
                                <p class="text-zinc-900 font-semibold text-sm md:text-base leading-snug mt-1">Japanese Shoyu Ramen<br>and Creamy Matcha</p>
                            </div>
                            <div class="flex items-baseline mt-3 text-[#c50c11]">
                                <span class="font-extrabold text-xl md:text-2xl self-start mr-1 mt-1">Rp</span>
                                <span class="font-black text-5xl md:text-6xl tracking-tight leading-none">64</span>
                                <div class="flex flex-col ml-1 leading-none self-end pb-1">
                                    <span class="font-bold text-xs md:text-sm line-through opacity-85">75k</span>
                                    <span class="font-black text-2xl md:text-3xl leading-none">K</span>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0 flex items-center justify-center pl-2">
                            <img src="{{ asset('img/Food/Makanan Combo1.png') }}" alt="Combo 1" class="h-32 sm:h-36 md:h-40 lg:h-44 w-auto object-contain">
                        </div>
                    </div>

                    <!-- COMBO 2 -->
                    <div class="bg-[#f1f0dc] rounded-3xl p-12 md:p-16 flex flex-row items-center justify-between shadow-lg">
                        <div class="flex flex-col justify-between h-full space-y-2">
                            <div>
                                <h3 class="text-[#c50c11] font-extrabold text-3xl md:text-4xl tracking-tight uppercase">COMBO 2</h3>
                                <p class="text-zinc-900 font-semibold text-sm md:text-base leading-snug mt-1">Japanese Miso Ramen<br>and Melon Soda Float</p>
                            </div>
                            <div class="flex items-baseline mt-3 text-[#c50c11]">
                                <span class="font-extrabold text-xl md:text-2xl self-start mr-1 mt-1">Rp</span>
                                <span class="font-black text-5xl md:text-6xl tracking-tight leading-none">70</span>
                                <div class="flex flex-col ml-1 leading-none self-end pb-1">
                                    <span class="font-bold text-xs md:text-sm line-through opacity-85">80k</span>
                                    <span class="font-black text-2xl md:text-3xl leading-none">K</span>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0 flex items-center justify-center pl-2">
                            <img src="{{ asset('img/Food/MakananCombo2.png') }}" alt="Combo 2" class="h-32 sm:h-360 md:h-40 lg:h-44 w-auto object-contain">
                        </div>
                    </div>

                    <!-- COMBO 3 -->
                    <div class="bg-[#f1f0dc] rounded-3xl p-12 md:p-16 flex flex-row items-center justify-between shadow-lg">
                        <div class="flex flex-col justify-between h-full space-y-2">
                            <div>
                                <h3 class="text-[#c50c11] font-extrabold text-3xl md:text-4xl tracking-tight uppercase">COMBO 3</h3>
                                <p class="text-zinc-900 font-semibold text-sm md:text-base leading-snug mt-1">Japanese Tori Paitan<br>and Cold Ocha</p>
                            </div>
                            <div class="flex items-baseline mt-3 text-[#c50c11]">
                                <span class="font-extrabold text-xl md:text-2xl self-start mr-1 mt-1">Rp</span>
                                <span class="font-black text-5xl md:text-6xl tracking-tight leading-none">68</span>
                                <div class="flex flex-col ml-1 leading-none self-end pb-1">
                                    <span class="font-bold text-xs md:text-sm line-through opacity-85">78k</span>
                                    <span class="font-black text-2xl md:text-3xl leading-none">K</span>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0 flex items-center justify-center pl-2">
                            <img src="{{ asset('img/Food/MakananCombo3.png') }}" alt="Combo 3" class="h-32 sm:h-36 md:h-40 lg:h-44 w-auto object-contain">
                        </div>
                    </div>

                    <!-- COMBO 4 -->
                    <div class="bg-[#f1f0dc] rounded-3xl p-12 md:p-16 flex flex-row items-center justify-between shadow-lg">
                        <div class="flex flex-col justify-between h-full space-y-2">
                            <div>
                                <h3 class="text-[#c50c11] font-extrabold text-3xl md:text-4xl tracking-tight uppercase">COMBO 4</h3>
                                <p class="text-zinc-900 font-semibold text-sm md:text-base leading-snug mt-1">Japanese Spicy Ramen<br>and Calpis Soda</p>
                            </div>
                            <div class="flex items-baseline mt-3 text-[#c50c11]">
                                <span class="font-extrabold text-xl md:text-2xl self-start mr-1 mt-1">Rp</span>
                                <span class="font-black text-5xl md:text-6xl tracking-tight leading-none">75</span>
                                <div class="flex flex-col ml-1 leading-none self-end pb-1">
                                    <span class="font-bold text-xs md:text-sm line-through opacity-85">85k</span>
                                    <span class="font-black text-2xl md:text-3xl leading-none">K</span>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0 flex items-center justify-center pl-2">
                            <img src="{{ asset('img/Food/MakananCombo4.png') }}" alt="Combo 4" class="h-32 sm:h-36 md:h-40 lg:h-44 w-auto object-contain">
                        </div>
                    </div>
        
            </div>
        </div>

        @include('partials.footer')
        
        <p></p>
    </body>
</html>