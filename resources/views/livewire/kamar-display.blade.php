<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 p-6 justify-between px-10">
    @foreach ($kamars as $kamar)
        <div class="flex flex-col items-center text-center bg-white p-4 cursor-pointer"
            wire:click="redirectToReservation({{ $kamar['id'] }})">
            <div class="w-full h-72 relative overflow-hidden">
                <img src="{{ $kamar['gambar'] ? asset('storage/' . $kamar['gambar']) : asset('images/room.jpg') }}"
                    alt="Gambar {{ $kamar['nomor_kamar'] }}"
                    class="absolute inset-0 w-full h-full object-cover rounded-t-lg transition-transform duration-500 ease-in-out hover:scale-110">
            </div>

            <h3 class="mt-4 text-xl font-semibold text-gray-800">{{ ucfirst($kamar['tipe_kamar']) }} Room</h3>
            <h3 class="text-md text-gray-800">Kamar No.{{ ucfirst($kamar['nomor_kamar']) }}</h3>

            <p class="mt-2 text-lg font-semibold text-orange-500">
                Rp {{ number_format($kamar['harga_per_malam'], 0, ',', '.') }} / PER NIGHT
            </p>
        </div>
    @endforeach
</div>