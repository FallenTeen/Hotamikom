<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

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
                    <span class="custom-caption text-uppercase text-white block mb-3">Welcome To Hotel Amikom <span
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

    <section class=" bg-gray-100">
        <div class="container mx-auto px-6 py-4  bg-white shadow-lg rounded-3xl -translate-y-12">
            <div class="row check-availabilty" id="next">
                <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
                    <form action="/room" method="get">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div class="mb-4">
                                    <label for="tgl_checkin" class="block font-semibold text-gray-700 mb-2">Tanggal
                                        Check In</label>
                                    <input type="date" id="tgl_checkin" name="tgl_checkin"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                                        placeholder="Select Check-in Date">
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_checkout" class="block font-semibold text-gray-700 mb-2">Tanggal
                                        Check Out</label>
                                    <input type="date" id="tgl_checkout" name="tgl_checkout"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                                        placeholder="Select Check-out Date">
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="mb-4">
                                    <label for="tipe_kamar" class="block font-semibold text-gray-700 mb-2">Tipe
                                        Kamar</label>
                                    <select name="tipe_kamar" id="tipe_kamar"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700">
                                        <option value="">Pilih Tipe Kamar</option>
                                        <option value="reguler">Regular</option>
                                        <option value="vip">VIP</option>
                                        <option value="suite">Suite</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="kapasitas"
                                        class="block font-semibold text-gray-700 mb-2">Kapasitas</label>
                                    <select name="kapasitas" id="kapasitas"
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
        <div id="profile" class="-mt-18 px-16">
            <div class="flex items-center gap-12">
                <div class="w-1/2">
                    <div class="grid grid-rows-4 gap-4">
                        <div class="row-span-1 font-Dmserif font-bold text-6xl">Selamat Datang</div>
                        <div class="row-span-2 items-center  justify-center text-2xl text-gray-700">
                            Hotel Amikom menawarkan kenyamanan dan fasilitas modern di pusat kota, dengan kamar luas,
                            pusat kebugaran, dan restoran terbaik untuk pengalaman menginap yang tak terlupakan.
                        </div>
                        <div class="row-span-1 mt-4">
                            <div class="flex gap-4 items-center">
                                <a href="/reservation"
                                    class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Jelajahi
                                </a>
                                <span><i>Atau</i></span>
                                <a href="/reservation"
                                    class="inline-block px-2 py-3 text-blue-600 font-semibold text-xl focus:outline-none">
                                    Reservasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 h-96 mb-12 bg-cover bg-center"
                    style="background-image: url('{{ asset('images/main-building.jpg') }}');">
                    <!-- Gambar berada di sini sebagai latar belakang -->
                </div>
            </div>
        </div>

    </section>


    <section id="kamar">
        <div class="bg-white w-full pt-16">
            <div class="grid space-y-8 justify-center items-center">
                <h1 class="text-6xl font-Dmserif font-bold text-center">Pilihan Kamar</h1>
                <p class="text-center  text-2xl text-gray-700 max-w-6xl"> Hotel Amikom menawarkan kenyamanan dan
                    fasilitas modern di pusat kota, dengan kamar luas,
                    pusat kebugaran, dan restoran terbaik untuk pengalaman menginap yang tak terlupakan.</p>
            </div>
            @livewire('kamar-display', ['jumlah_display' => 1, 'rekomendasi' => 'aktif'])
        </div>
    </section>

    <section id="layanans" class="relative bg-cover bg-center pb-12"
        style="background-image: url('{{ asset('images/room.jpg') }}'); background-attachment: fixed;">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col pt-12 gap-12">
                <div class="text-center flex flex-col gap-8" data-aos="fade-up">
                    <h1 class="text-6xl font-Dmserif font-bold text-white">Layanan Tambahan</h1>
                    <p class="text-2xl text-white">
                        Hotel Amikom menawarkan kenyamanan dan fasilitas modern di pusat kota, dengan kamar luas, pusat
                        kebugaran, dan restoran terbaik untuk pengalaman menginap yang tak terlupakan.
                    </p>
                </div>

                <div> @livewire('layanan-display')</div>

            </div>
        </div>
    </section>

    <section>
        @livewire('review-display')
    </section>

    <section id="resnow" class="relative bg-cover bg-center pb-12"
        style="background-image: url('{{ asset('images/rand.jpg') }}'); background-attachment: fixed;">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col pt-12 gap-12">
                <div class="justify-between mx-12 flex flex-row gap-8" data-aos="fade-up">
                    <h1 class="text-6xl font-Dmserif font-bold text-white">Reservasi Sekarang</h1>
                    <a class="flex items-center justify-center text-white border-2 rounded-full px-6" href="{{ route('res') }}">Klik Disini Untuk Reservasi</a>
                   
                </div>

            </div>
        </div>
    </section>
    <section>
        <x-footer></x-footer>
    </section>
</body>

</html>