<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - HOME</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
    <body class="">

        
        @include('partials.landing.header')
        <img src="{{ asset('img/Background/BG-Header-Home.png') }}"
            class="-mt-40 relative z-0 justify-centerd w-full bg-cover bg-center bg-no-repeat flex items-center">

        <div class="bg-[#201B1B] h-160 py-20">
            <div class="ml-20 mt-20">
                <img src="{{ asset('img/Logo/LogoWithName.png') }}"
                class="h-20">
                <h1 class="text-5xl text-[#F9FF43] font-bold py-6">
                    Enjoy the true <br> Japanese ramen soup</h1>
                <p class="text-white text-2xl">Our soup distributed directly from Japan and<br> we guarantee you the best quality from our <br> dish.</p>
            </div>
            </div>
            <div class="flex h-120 gap-10 justify-end -mt-140 mb-20">
                <img src="{{ asset('img/Food/Home-1.png') }}" class="mr">
                <img src="{{ asset('img/Food/Home-2.png') }}" class="mr-20">
            </div>
            <div>
        </div>



        <div class="bg-[#7F0017] h-280">
            <div class="flex justify-between py-10">
                <img src="{{ asset('img/Design/HomeFestive.png') }}"class="h-60 -mt-10" >
                <img src="{{ asset('img/Logo/Logo-Under.png') }}" class="h-60 mr-10">
            </div>
            
                {{-- Kotak Combo Bagian 1 --}}
                <div class="relative z-10 flex justify-items-center grid grid-cols-1 sm:grid-cols-2 gap-10">
                    <div class="flex bg-[#FDFCE7] h-60 w-160 rounded-4xl ml-20">
                    
                        <div class="px-5 py-5">
                            <h1 class="text-[#CE0C11] text-6xl font-bold"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">COMBO 1</h1>
                            <p class="py-3 ml-4 text-[22px] font-medium leading-6">Japanese Shoyu Ramen<br> and Creamy Matcha</p>
                        
                            <div class="flex">
                                <h1 class="ml-4 text-3xl text-[#CE0C11] font-bold"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">Rp</h1>
                                <h1 class="text-[#CE0C11] font-black mt-2 ml-2 text-7xl"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">64</h1>
                                <div class="mt-4 ml-2"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">
                                <p class="text-[#CE0C11] font-bold line-through">75K</p>
                                <p class="text-[#CE0C11] font-black text-4xl">K</p>
                            </div>
                        </div>
                    </div>
                        <img src="{{ asset('img/Food/HomeCombo1.png') }}" class="h-70">    
                </div>
            
                {{-- Kotak Combo Bagian 2 --}}
                <div class="relative z-10 flex bg-[#FDFCE7] h-60 w-160 rounded-4xl mr-20">
                    <div class="px-5 py-5">
                            <h1 class="text-[#CE0C11] text-6xl font-bold"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">COMBO 1</h1>
                            <p class="py-3 ml-4 text-[22px] font-medium leading-6">Japanese Shoyu Ramen<br> and Creamy Matcha</p>
                    
                            <div class="flex">
                                <h1 class="ml-4 text-3xl text-[#CE0C11] font-bold"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">Rp</h1>
                                <h1 class="text-[#CE0C11] font-black mt-2 ml-2 text-7xl"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">64</h1>
                                <div class="mt-4 ml-2"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">
                                <p class="text-[#CE0C11] font-bold line-through">75K</p>
                                <p class="text-[#CE0C11] font-black text-4xl">K</p>
                            </div>
                        </div>
                    </div>
                        <img src="{{ asset('img/Food/HomeCombo2.png') }}" class="h-60">   
                </div>
            
                {{-- Kotak Combo Bagian 3 --}}
                <div class="relative z-10 flex bg-[#FDFCE7] h-60 w-160 rounded-4xl ml-20">
                    <div class="px-5 py-5">
                            <h1 class="text-[#CE0C11] text-6xl font-bold"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">COMBO 1</h1>
                            <p class="py-3 ml-4 text-[22px] font-medium leading-6">Japanese Shoyu Ramen<br> and Creamy Matcha</p>
                    
                            <div class="flex">
                                <h1 class="ml-4 text-3xl text-[#CE0C11] font-bold"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">Rp</h1>
                                <h1 class="text-[#CE0C11] font-black mt-2 ml-2 text-7xl"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">64</h1>
                                <div class="mt-4 ml-2"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">
                                <p class="text-[#CE0C11] font-bold line-through">75K</p>
                                <p class="text-[#CE0C11] font-black text-4xl">K</p>
                            </div>
                        </div>
                    </div>
                        <img src="{{ asset('img/Food/HomeCombo3.png') }}" class="h-60">   
                </div>
            
                {{-- Kotak Combo Bagian 4 --}}
                <div class="relative z-10 flex bg-[#FDFCE7] h-60 w-160 rounded-4xl mr-20">
                    <div class="px-5 py-5">
                            <h1 class="text-[#CE0C11] text-6xl font-bold"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">COMBO 1</h1>
                            <p class="py-3 ml-4 text-[22px] font-medium leading-6">Japanese Shoyu Ramen<br> and Creamy Matcha</p>
                    
                            <div class="flex">
                                <h1 class="ml-4 text-3xl text-[#CE0C11] font-bold"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">Rp</h1>
                                <h1 class="text-[#CE0C11] font-black mt-2 ml-2 text-7xl"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">64</h1>
                                <div class="mt-4 ml-2"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5)">
                                <p class="text-[#CE0C11] font-bold line-through">75K</p>
                                <p class="text-[#CE0C11] font-black text-4xl">K</p>
                            </div>
                        </div>
                    </div>
                        <div class="flex justify-center">
                            <img src="{{ asset('img/Food/HomeCombo4.png') }}" class="h-60 w-full object-cover">
                        </div>   
                </div>
                
            </div>
            <img src="{{ asset('img/Background/BG-Food-Home.png') }}" alt="Food Background" class="flex relative z-0 -mt-55 w-full bg-cover bg-center bg-no-repeat justify-center">
        </div>

        <div>
        <div class="bg-[#201B1B] h-240 relative z-10">
            <div class="">
                <h1 class="flex justify-center text-[#F9FF43] text-8xl font-bold py-12 px-54">About Us</h1>
                
            </div>
            <div class="flex ml-10 mt-10">
                <div>
                    <div class="flex gap-8">
                        <div class="bg-[#F7F7F7] h-80 w-120 rounded-4xl">
                            <img src="{{ asset('img/Logo/Logo-Pure.png') }}" class="ml-105 mt-2 h-15">
                            <div class="ml-42 bg-amber-300 h-35 w-35 rounded-[70px] ">
                                <img src="" alt="">
                            </div>
                            <div class="ml-36 mt-2">
                                <p class="text-2xl font-bold text-[#676767]">Felix Yonathan</p>
                                <p class="font-bold text-[#676767] ml-4">UI/UX Designer</p>
                            </div>
                        </div>
                        <div class="bg-[#F7F7F7] h-80 w-120 rounded-4xl">
                            <img src="{{ asset('img/Logo/Logo-Pure.png') }}" class="ml-105 mt-2 h-15">
                            <div class="ml-42 bg-amber-300 h-35 w-35 rounded-[70px] ">
                                <img src="" alt="">
                            </div>
                            <div class="ml-36 mt-2">
                                <p class="text-2xl font-bold text-[#676767]">Michael Yusliardy</p>
                                <p class="font-bold text-[#676767] ml-6">Full Stack - Developer</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-8 mt-8">
                        <div class="bg-[#F7F7F7] h-80 w-120 rounded-4xl">
                            <img src="{{ asset('img/Logo/Logo-Pure.png') }}" class="ml-105 mt-2 h-15">
                            <div class="ml-42 bg-amber-300 h-35 w-35 rounded-[70px] ">
                                <img src="" alt="">
                            </div>
                            <div class="ml-36 mt-2">
                                <p class="text-2xl font-bold text-[#676767]">Nicholas Jonathan</p>
                                <p class="font-bold text-[#676767] ml-6">UI/UX Designer</p>
                            </div>
                        </div>
                        <div class="bg-[#F7F7F7] h-80 w-120 rounded-4xl">
                            <img src="{{ asset('img/Logo/Logo-Pure.png') }}" class="ml-105 mt-2 h-15">
                            <div class="ml-42 bg-amber-300 h-35 w-35 rounded-[70px] ">
                                <img src="" alt="">
                            </div>
                            <div class="ml-36 mt-2">
                                <p class="text-2xl font-bold text-[#676767]">Devon Austin.V</p>
                                <p class="font-bold text-[#676767] ml-6">UI/UX Designer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-20 text-[29px] px-2">
                    <p class="text-white">We are a team of four students who share the same interest in creating a unique ramen shop concept. Through this project, we combine our ideas, creativity, and skills to create a simple yet appealing experience for ramen lovers. This project also gives us an opportunity to learn, collaborate, and turn our ideas into something we can be proud of.</p>
                </div>
            </div>
            
        </div>


            <div 
              style="background-image: url('{{ asset('img/Background/BG-Home-Chill.png') }}');" 
              class="relative h-300 w-full bg-cover bg-center bg-no-repeat flex justify-center">
                <div>
                    <p class="text-[#F9FF43] text-8xl font-bold mt-12 flex justify-center">Contact Us</p>
                    <div class="mt-10">
                        <a href="{{ route('contact') }}" class="text-white underline flex justify-center text-2xl">for more information -></a>
                    </div>
                    <div class="mt-40">
                        <h1 class="text-white font-medium text-4xl text-center">Need an expert? you are more than welcomed to leave your contact info <br> and we will being touch shortly</h1>
                    </div>
                    <div class="flex gap-30 justify-between">
                        <div class="flex justify-center mt-30">
                            <section class="bg-[#7F0017] h-120 w-90 rounded-4xl shadow-2xs flex flex-col items-center">
                                <img src="{{ asset('img/Icon/Home.png') }}" class="mt-20">
                                <p class="text-[#F9FF43] mt-8 text-2xl font-bold">Visit Us</p>
                                <p class="text-white flex px-2 text-center mt-12 text-xl font-bold">Jl.Sisingamangaraja.Blok 3E Pontianak, Kalimantan Barat</p>
                            </section>
                        </div>
                        <div class="flex justify-center mt-30">
                            <section class="bg-[#7F0017] h-120 w-90 rounded-4xl shadow-2xs flex flex-col items-center">
                                <img src="{{ asset('img/Icon/Telephone.png') }}" class="mt-20">
                                <p class="text-[#F9FF43] mt-8 text-2xl font-bold">Call Us</p>
                                <p class="text-white flex px-2 text-center mt-18 text-xl font-bold">+62 (821) 1234 5678</p>
                            </section>
                        </div>
                        <div class="flex justify-center mt-30">
                            <section class="bg-[#7F0017] h-120 w-90 rounded-4xl shadow-2xs flex flex-col items-center">
                                <img src="{{ asset('img/Icon/Email.png') }}" class="mt-20">
                                <p class="text-[#F9FF43] mt-8 text-2xl font-bold">Gmail</p>
                                <p class="text-white flex px-2 text-center mt-18 text-xl font-bold">dinelogiq@gmail.com</p>
                            </section>
                        </div>
                        </div>
                    </div>    
                </div>
                
            </div>
        </div>    



        



        
        @include('partials.landing.footer')
        

        
        <p></p>
    </body>
</html>
