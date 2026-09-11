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
        <div class="bg-[#7F0017] w-full h-auto px-4">
            <div class="py-30 px-20 bg-white w-full h-auto rounded-4xl">
                <div class="flex justify-between">
                    <div>                    
                        <img src="{{ asset('img/Logo/LogoWithNameBlack.png') }}" class="h-22">
                        <div class="mt-4">
                            <div class="flex gap-4">
                                <img src="{{ asset('img/Logo/Location.png') }}" class="h-12 w-10">
                                <div>
                                    <p class="text-4xl">Jl. Sisingamangaraja,<br>Blok 3E </p>
                                    <p class="font-extralight text-[#515151] text-xl">Taman mawar, pusat kota <br>Jakarta, EX356611</p>
                                </div>
                            </div>
                            <div class="flex mt-8 gap-4">
                                <img src="{{ asset('img/Logo/Call.png') }}" class="h-10 w-10">
                                <p class="text-3xl font-medium">082155487766</p>
                            </div>
                            <div class="flex mt-8 gap-4">
                                <img src="{{ asset('img/Logo/Clock.png') }}" class="w-10 h-10">
                                <div>
                                <p class="text-[30px] font-bold -mt-2">Open Hours</p>
                                <p>Everyday <b>8AM - 11PM</b></p>
                                </div>
                            </div>
                            <div class="hover:scale-110 duration-300 mt-20">
                                <a href="{{ route('cart') }}" class="bg-[#7F0017] h-auto w-auto px-20 py-10 mt-8 rounded-4xl text-white font-bold text-3xl">Book an appointment</a>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('img/Background/BG-Location-1.png') }}" class="flex justify-end">
                </div>
                <img src="{{ asset('img/Background/BG-Location-2.png') }}" class="w-full mt-20">
            </div>

        </div>


        
        @include('partials.landing.footer')



    </body>
</html>