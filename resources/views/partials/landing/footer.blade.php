<footer class="relative">
    
    {{-- Background Image --}}
    <img src="{{ asset('img/Background/BG-Footer.png') }}" 
         class="absolute inset-0 w-full h-full justify-center object-cover" 
         alt="Footer Background">
    
    <div class="relative z-10 flex justify-center -ml-140">
        
        {{-- Logo Section --}}
        <img src="{{ asset('img/Logo/LogoWithName.png') }}" 
             class="h-full w-48 ml-32 mt-10" 
             alt="Dinelogiq Logo">

        {{-- Social Media & Copyright Section --}}
        <div class="relative z-10 flex -ml-48 mt-60">
            <img src="{{ asset('img/Logo/Tiktok.png') }}" class="w-8 h-8 ml-2" alt="Tiktok">
            <img src="{{ asset('img/Logo/Instagram.png') }}" class="w-8 h-8 ml-2" alt="Instagram">
            <img src="{{ asset('img/Logo/Twitter.png') }}" class="w-8 h-8 ml-2" alt="Twitter">
            <img src="{{ asset('img/Logo/Facebook.png') }}" class="w-8 h-8 ml-2" alt="Facebook">
            <h1 class="text-white font-black mt-10 h-30 -ml-52 text-xl">Copyright © 2026 Dinelogiq</h1>
        </div>

        {{-- Navigation Links Section --}}
        <div class="relative z-10 flex mt-16 ml-24">
            <ul>
                <li class="text-white mt-1 font-black text-xl">DISCOVER</li>
                <li class="text-white mt-1 font-black text-xl">MORE</li>
                <li class="text-white mt-1">Home</li>
                <li class="text-white mt-1">Menu</li>
                <li class="text-white mt-1">Location</li>
                <li class="text-white mt-1">Contact</li>
                <li class="text-white mt-1">About</li>
                <li class="text-white mt-1">Terms & Condition</li>
                <li class="text-white mt-1">Privacy & Policy</li>
            </ul>
        </div>

        {{-- Contact Information Section --}}
        <div class="relative z-10 mt-16.5 ml-30"> 
            
            {{-- Visit Us --}}
            <div class="relative z-10 flex">
                <ul>
                    <li class="text-white font-black text-xl">VISIT US IN</li>
                    <li class="text-white">Jl. Sisingamangaraja, Blok 3E</li>
                </ul>
            </div>
            
            {{-- Opening Hours --}}
            <div class="relative z-10 flex mt-10">
                <ul>
                    <li class="text-white font-black text-xl">OPENING HOURS</li>
                    <li class="text-white">Everyday <b>8AM - 11PM</b></li>
                </ul>
            </div>
            
            {{-- Contact Us --}}
            <div class="relative z-10 flex mt-10">
                <ul>
                    <li class="text-white font-black text-xl flex">CONTACT US</li>
                    <li class="text-white flex gap-2">
                        <img src="{{ asset('img/Logo/Whatsapp.png') }}" alt="Whatsapp">
                        082155487766
                    </li>
                    <li class="text-white flex gap-2">
                        <img src="{{ asset('img/Logo/Gmail.png') }}" alt="Gmail">
                        dinelogiqcon@outlook.com
                    </li>
                </ul>
            </div>
            
        </div>     
        
    </div>
</footer>