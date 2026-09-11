<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.landing.header')
    <div class="bg-[#7F0017] w-full h-auto px-3 py-3">
        <div class="bg-white w-full h-auto rounded-2xl hover:border-green-600 duration-300 px-5 py-5">
            <button onclick="history.back()">
                <img src="{{ asset('img/Icon/back.png') }}" alt="back" class="h-15 w-15 hover:scale-105 duration-300">
            </button>
            <div class="flex mt-10 gap-30">

                <div class="bg-[#E4DEB9] rounded-[350px] ml-5  h-170 w-170 flex justify-center items-center">
                    <img src="{{ asset('img/Food/ShoyuRamen-Detail.png') }}" alt="" class="h-150 w-150">
                </div>
                <div class="">
                    <div class="flex gap-4">
                        <p class="font-black text-4xl">Shoyu Ramen</p>
                        <img src="{{ asset('img/Icon/Like.png') }}" alt="" class="h-8 w-8">
                    </div>

                    <p class="text-2xl mt-5">known for its clear, soy-sauce–based broth and <br> balanced, savory flavor. Made by combining <br> chicken, pork, seafood, or vegetable<br> stocks with aromatic seasonings</p>
                    <p class="mt-8 font-black text-2xl">Size</p>
                    {{-- Small Medium Large Button --}}
                    <div class="flex items-center gap-3 mt-2">
                        @foreach(['S' => 'Small', 'M' => 'Medium', 'L' => 'Large'] as $value => $label)
                            <label class="cursor-pointer">
                                <input type="radio" 
                                       name="size" 
                                       value="{{ $value }}" 
                                       class="peer sr-only"
                                       {{ old('size', 'M') == $value ? 'checked' : '' }}>
                                <div class="w-14 h-8 flex items-center justify-center 
                                            border-2 border-[#D1DADD] rounded-full 
                                            font-bold text-gray-900 bg-white
                                            peer-checked:bg-[#8B0000] peer-checked:text-white peer-checked:border-[#8B0000]
                                            peer-checked:shadow-[0_0_15px_rgba(139,0,0,0.5)] duration-500">
                                    {{ $value }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p class="mt-4 text-xl font-bold text-[#7F0017]">Rp55.000</p>
                    <p class="mt-10 text-xl font-black">Add-ons</p>
                    <div class="flex gap-10 mt-2">
                        <div>
                            <div class="h-20 w-20 border-1 border-[#959595] shadow-2xl hover:border-green-600 duration-300 rounded-xl">
                                <img src="{{ asset('img/Food/Detail-1.png') }}" alt="sweetcorny💔" class="mt-4 ml-1 w-17">
                            </div>
                            <p class="text-center">sweetcorn</p>
                            <p class="text-center font-black">Rp2.000</p>
                        </div>
                        <div>
                            <div class="h-20 w-20 border-1 border-[#959595] shadow-2xl hover:border-green-600 duration-300 rounded-xl">
                                <img src="{{ asset('img/Food/Detail-2.png') }}" alt="sweetcorny💔" class="mt-4 ml-1 w-17">
                            </div>
                            <p class="text-center">green onion</p>
                            <p class="text-center font-black">Rp2.000</p>
                        </div>
                        <div>
                            <div class="h-20 w-20 border-1 border-[#959595] shadow-2xl hover:border-green-600 duration-300 rounded-xl">
                                <img src="{{ asset('img/Food/Detail-3.png') }}" alt="sweetcorny💔" class="mt-4 ml-1 w-17">
                            </div>
                            <p class="text-center">uzumaki</p>
                            <p class="text-center font-black">Rp5.000</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div>
                            <p class="font-bold mt-5 text-xl">Total Amount</p>
                            <p class="font-black text-[#7F0017] text-2xl">Rp57.000</p>
                        </div>
                    <button class="flex items-center mt-6 bg-[#7F0017]  text-white font-black text-xl px-10 hover:scale-105 duration-300 rounded-4xl">
                        Add to Cart
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>