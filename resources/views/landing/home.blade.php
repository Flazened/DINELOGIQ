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
            class="-mt-40 realtive z-0">
        

        



        
        @include('partials.landing.footer')
        

        
        <p></p>
    </body>
</html>
