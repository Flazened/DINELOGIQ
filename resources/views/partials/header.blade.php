<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DINELOGIQ')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <div class="bg-gradient-to-b from-black/80 via-transparent to-black/80">
            <img src="{{ 
                request()->routeIs('home') ? asset('img/Background/Home-Header-BG.png') :
                (request()->routeIs('menu') ? asset('img/Background/Menu-Header-BG.png') :
                (request()->routeIs('location') ? asset('img/Background/Home-Header-BG.png') :
                (request()->routeIs('contact') ? asset('img/Background/Home-Header-BG.png') :
                asset('img/Background/Home-Header-BG.png'))))
                }}"
        class="{{ 
            request()->routeIs('home') ? 'absolute inset-0 scale-120 mt-35' :
            (request()->routeIs('menu') ? 'absolute inset-0 scale-102' :
            (request()->routeIs('location') ? 'absolute inset-0 scale-120 mt-35' :
            (request()->routeIs('contact') ? 'absolute inset-0 scale-120 mt-35' :
            'absolute inset-0 scale-120 mt-35')))
        }}">
        <!-- Menu -->
        <ul class="relative z-20 flex justify-center gap-8 md:gap-20 pt-10">
            
            <!-- HOME -->
            <li>
                <a href="{{ route('home') }}" 
                   class="relative font-bold text-white text-3xl after:absolute after:-bottom-2 after:left-0 after:h-1 after:rounded-full after:transition-all after:duration-300 
                   {{ request()->routeIs('home') ? 'after:w-full after:bg-yellow-400' : 'after:w-0 hover:after:w-full hover:after:bg-yellow-400' }}">
                    Home
                </a>
            </li>

            <!-- MENU -->
            <li>
                <a href="{{ route('menu') }}" 
                   class="relative font-bold text-white text-3xl after:absolute after:-bottom-2 after:left-0 after:h-1 after:rounded-full after:transition-all after:duration-300 
                   {{ request()->routeIs('menu') ? 'after:w-full after:bg-yellow-400' : 'after:w-0 hover:after:w-full hover:after:bg-yellow-400' }}">
                    Menu
                </a>
            </li>

            <!-- LOCATION -->
            <li>
                <a href="{{ route('location') }}" 
                   class="relative font-bold text-white text-3xl after:absolute after:-bottom-2 after:left-0 after:h-1 after:rounded-full after:transition-all after:duration-300 
                   {{ request()->routeIs('location') ? 'after:w-full after:bg-yellow-400' : 'after:w-0 hover:after:w-full hover:after:bg-yellow-400' }}">
                    Location
                </a>
            </li>

            <!-- CONTACT -->
            <li>
                <a href="{{ route('contact') }}" 
                   class="relative font-bold text-white text-3xl after:absolute after:-bottom-2 after:left-0 after:h-1 after:rounded-full after:transition-all after:duration-300 
                   {{ request()->routeIs('contact') ? 'after:w-full after:bg-yellow-400' : 'after:w-0 hover:after:w-full hover:after:bg-yellow-400' }}">
                    Contact
                </a>
            </li>

            <!-- ABOUT -->
            <li>
                <a href="{{ route('about') }}" 
                   class="relative font-bold text-white text-3xl after:absolute after:-bottom-2 after:left-0 after:h-1 after:rounded-full after:transition-all after:duration-300 
                   {{ request()->routeIs('about') ? 'after:w-full after:bg-yellow-400' : 'after:w-0 hover:after:w-full hover:after:bg-yellow-400' }}">
                    About
                </a>
            </li>

        </ul>
        </div>
    </header>
</body>
</html>