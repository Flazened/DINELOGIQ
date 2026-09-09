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
        <div class="bg-[#7F0017] h-auto w-full py-10">
            <div class="px-20">
                <p class="text-[#F9FF43] text-6xl font-bold">Contact Us</p>
                <p class="text-white mt-10 text-2xl font-medium">Need an expert? you are more than welcomed to leave your <br> contact info and we will being touch shortly</p>
            </div>
            <div class="flex">
                <div class="bg-white h-120 w-200 mt-40 px-20 py-20">
                    <p class="text-3xl font-medium">Need more infomation?</p>
                    <p class="mt-10 font-medium">a connected set of services designed to turned strategy into scale!</p>
                    <div class="flex justify-between mt-20">
                        <div class="h-20 w-160">
                            <img src="{{ asset('img/Icon/Contact-telephone.png') }}" alt="" class="ml-11 h-15 w-auto">
                            <p class="font-medium text-center">+62 (821) 5548 7766</p>
                        </div>
                        <div class="ml-20">
                            <img src="{{ asset('img/Icon/Contact-mail.png') }}" alt="" class="ml-14 h-15 w-auto">
                            <p class="font-medium text-center">dineloqic@outlook.com</p>
                        </div>
                        <div class="ml-20">
                            <img src="{{ asset('img/Icon/Contact-location.png') }}" alt="" class="ml-11 h-15 w-auto">
                            <p class="font-medium text-center">Jl.Sisingamangaraja Blok 3EPontianak, Kalimantan Barat <br> Indonesia</p>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('img/Background/BG-Contact-1.png') }}" class="h-auto w-120 -mt-40">
            </div>
        </div>
        <div class="bg-white h-auto w-full px-20 py-20">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-6xl font-black">Send Message</h1>
                    <p class="mt-10 text-3xl font-light">Please fill out the form below with your details and message </p>
                    <div>
                        
                    </div>
                </div>
                <img src="{{ asset('img/Background/Menu-BG-Map.png') }}" class="h-200 w-auto">
            </div>
        </div>


        
        @include('partials.landing.footer')



    </body>
</html>