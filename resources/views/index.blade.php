<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Ini pake nya alip js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-Poppin bg-gray-300">
    <x-navbar />

    <!-- Section 1: Hero Section -->
    <section class="site-hero h-screen relative bg-cover bg-center"
        style="background-image: url('{{ asset('images/main-building.jpg') }}'); background-attachment: fixed;">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto px-4 relative z-10 h-full">
            <div class="flex justify-center items-center h-full">
                <div class="text-center" data-aos="fade-up">
                    <span class="custom-caption text-uppercase text-white block mb-3">Welcome To Hotel Amikom  <span
                            class="fa fa-star text-primary"></span> Hotel</span>
                    <h1 class="heading text-4xl font-bold text-white">A Best Place To Stay</h1>
                </div>
            </div>
        </div>
        <a class="mouse smoothscroll absolute bottom-10 left-1/2 transform -translate-x-1/2" href="#next">
            <div class="mouse-icon">
                <span class="mouse-wheel text-white"></span>
            </div>
        </a>
    </section>

    <section class="bg-white rounded-3xl py-16">
        <div class="container mx-auto px-4">
            <div class="row check-availabilty" id="next">
                <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
                    <form action="/room" method="get">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div class="mb-4">
                                    <label for="checkin_date" class="block font-semibold text-gray-700 mb-2">Tanggal
                                        Check In</label>
                                    <input type="date" id="checkin_date" name="checkin_date"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                                        placeholder="Select Check-in Date">
                                </div>
                                <div class="mb-4">
                                    <label for="checkout_date" class="block font-semibold text-gray-700 mb-2">Tanggal
                                        Check Out</label>
                                    <input type="date" id="checkout_date" name="checkout_date"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                                        placeholder="Select Check-out Date">
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="mb-4">
                                    <label for="room_type" class="block font-semibold text-gray-700 mb-2">Tipe
                                        Kamar</label>
                                    <select name="room_type" id="room_type"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700">
                                        <option value="">Pilih Tipe Kamar</option>
                                        <option value="single">Regular</option>
                                        <option value="double">VIP</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="capacity"
                                        class="block font-semibold text-gray-700 mb-2">Kapasitas</label>
                                    <select name="capacity" id="capacity"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700">
                                        <option value="">Pilih Kapasitas</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <button type="submit"
                                class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Cek Ketersediaan Kamar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="bg-white w-full">
            Telusuri
        </div>
    </section>

    <section class="site-hero h-screen relative bg-cover bg-center"
        style="background-image: url('{{ asset('images/room.jpg') }}'); background-attachment: fixed;">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="container mx-auto px-4 relative z-10 h-full">
            <div class="flex justify-center items-center h-full">
                <div class="text-center" data-aos="fade-up">
                    <span class="custom-caption text-uppercase text-white block mb-3">Experience Luxury</span>
                    <h1 class="heading text-4xl font-bold text-white">Relax and Enjoy Your Stay</h1>
                </div>
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</body>

</html>