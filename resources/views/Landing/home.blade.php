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
        
        <!-- Tambahkan class relative dan z-10 agar naik ke atas background -->
        <div class="relative z-10 mt-300 -ml-20">
            <img src="{{ asset('img/Logo/LogoWithName.png') }}" class="scale-40">
            <p class="text-yellow-300 font-bold ml-60 -mt-15 mb-10 text-6xl">Enjoy the true<br>Japanese ramen soup</p>
            <p class="text-white ml-60 text-3xl">Our soup distributed directly from Japan and <br>we guarantee you the best quality from it.</p>
        </div>

        @include('partials.footer')
        
        <p></p>
    </body>
</html>