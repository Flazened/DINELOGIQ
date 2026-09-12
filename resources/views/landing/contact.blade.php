<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - CONTACT</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- ==========================================
         HEADER SECTION
    ========================================== --}}
    @include('partials.landing.header')

    {{-- ==========================================
         CONTACT INFO & HERO SECTION
    ========================================== --}}
    <div class="bg-[#7F0017] h-auto w-full py-10">
        <div class="px-20">
            <p class="text-[#F9FF43] text-6xl font-bold">Contact Us</p>
            <p class="text-white mt-10 text-2xl font-medium">
                Need an expert? you are more than welcomed to leave your <br> 
                contact info and we will being touch shortly
            </p>
        </div>
        
        <div class="flex">
            {{-- Contact Info Card --}}
            <div class="bg-white h-120 w-200 mt-40 px-20 py-20">
                <p class="text-3xl font-medium">Need more infomation?</p>
                <p class="mt-10 font-medium">a connected set of services designed to turned strategy into scale!</p>
                
                <div class="flex justify-between mt-20">
                    {{-- Phone --}}
                    <div class="h-20 w-160">
                        <img src="{{ asset('img/Icon/Contact-telephone.png') }}" alt="Telephone Icon" class="ml-11 h-15 w-auto">
                        <p class="font-medium text-center">+62 (821) 5548 7766</p>
                    </div>
                    
                    {{-- Email --}}
                    <div class="ml-20">
                        <img src="{{ asset('img/Icon/Contact-mail.png') }}" alt="Mail Icon" class="ml-14 h-15 w-auto">
                        <p class="font-medium text-center">dineloqic@outlook.com</p>
                    </div>
                    
                    {{-- Location --}}
                    <div class="ml-20">
                        <img src="{{ asset('img/Icon/Contact-location.png') }}" alt="Location Icon" class="ml-11 h-15 w-auto">
                        <p class="font-medium text-center">
                            Jl.Sisingamangaraja Blok 3E Pontianak, Kalimantan Barat <br> Indonesia
                        </p>
                    </div>
                </div>
            </div>
            
            {{-- Decorative Image --}}
            <img src="{{ asset('img/Background/BG-Contact-1.png') }}" alt="Contact Background" class="h-auto w-120 -mt-40">
        </div>
    </div>

    {{-- ==========================================
         CONTACT FORM SECTION
    ========================================== --}}
    <div class="bg-white h-auto w-full px-20 py-20">
        <div class="flex justify-between">
            
            {{-- Left Side: Form --}}
            <div>
                <h1 class="text-5xl font-black">Send Message</h1>
                <p class="mt-10 text-2xl font-light">Please fill out the form below with your details and message</p>
                
                <form action="#" method="POST">
                    {{-- First Name & Last Name --}}
                    <div class="flex mt-30 gap-20">
                        <div class="flex flex-col">
                            <p class="text-2xl">First Name</p>
                            <section class="h-20 w-80 border border-black mt-5 rounded-[20px] flex items-center">
                                <input class="text-black px-10 text-2xl focus:outline-none w-full rounded-[20px]" type="text" placeholder="First Name"> 
                            </section>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-2xl">Last Name</p>
                            <section class="h-20 w-80 border border-black mt-5 rounded-[20px] flex items-center">
                                <input class="text-black px-10 text-2xl focus:outline-none w-full rounded-[20px]" type="text" placeholder="Last Name"> 
                            </section>
                        </div>
                    </div>

                    {{-- Email or Phone Number --}}
                    <div class="flex flex-col mt-20">
                        <p class="text-2xl">Email or phone number</p>
                        <section class="h-20 w-full border border-black mt-5 rounded-[20px] flex items-center">
                            <input class="text-black px-10 text-2xl focus:outline-none w-full rounded-[20px]" type="text" placeholder="your@email.com or +62..."> 
                        </section>
                    </div>

                    {{-- Message --}}
                    <div class="flex flex-col mt-20">
                        <p class="text-2xl">Write your message</p>
                        {{-- Diperbaiki menjadi <textarea> agar bisa mengetik pesan panjang (multi-line), 
                             sambil tetap mempertahankan desain dan class yang sama persis --}}
                        <section class="h-60 w-full border border-black mt-5 rounded-[20px]">
                            <textarea class="text-black px-10 py-10 text-2xl focus:outline-none w-full h-full resize-none rounded-[20px]" placeholder="Type your message here..."></textarea>
                        </section>
                    </div>
                    
                    {{-- Submit Button --}}
                    <button type="submit" class="relative z-10 bg-[#7F0017] hover:bg-amber-900 transition-all duration-300 mt-20 h-20 w-full rounded-3xl flex justify-center items-center text-white font-bold text-2xl">
                        Submit
                    </button>
                </form>
            </div>

            {{-- Right Side: Map Image --}}
            <img src="{{ asset('img/Background/Menu-BG-Map.png') }}" alt="Map Background" class="h-280 w-auto px-20">
            
        </div>
    </div>

    {{-- ==========================================
         FOOTER SECTION
    ========================================== --}}
    @include('partials.landing.footer')

</body>
</html>