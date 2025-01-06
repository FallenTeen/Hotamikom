<form wire:submit.prevent="store">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <div class="col-span-1 pr-4">
            <div class="mb-2">
                <label for="id_kamar" class="block font-semibold text-gray-700 mb-2">Pilih Kamar</label>
                <select wire:model="id_kamar" id="id_kamar"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700"
                    wire:change="calculateTotal">
                    <option value="">Pilih Kamar</option>
                    @foreach($kamars as $kamar)
                        <option value="{{ $kamar->id }}">
                            {{ ucfirst($kamar->tipe_kamar) }} - Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}
                            /
                            malam
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-8 w-full">
                <div class="mb-4 w-1/2">
                    <label for="tgl_checkin" class="block font-semibold text-gray-700 mb-2">Tanggal Check-in</label>
                    <input type="date" wire:model="tgl_checkin" id="tgl_checkin" name="tgl_checkin"
                        wire:change="calculateTotal()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        wire:change="calculateTotal">
                </div>

                <div class="mb-4 w-1/2">
                    <label for="tgl_checkout" class="block font-semibold text-gray-700 mb-2">Tanggal Check-out</label>
                    <input type="date" wire:model="tgl_checkout" id="tgl_checkout" name="tgl_checkout"
                        wire:change="calculateTotal()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        wire:change="calculateTotal" min="{{ \Carbon\Carbon::parse($tgl_checkin)->format('Y-m-d') }}">
                </div>
            </div>
        </div>
        <div class="mb-2 col-span-1 pl-4">
            <label class="block font-semibold text-gray-700 mb-2">Pilih Layanan Tambahan</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($layanans as $layanan)
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="layanan" value="{{ $layanan->id }}"
                            wire:change="calculateTotal()" id="layanan_{{ $layanan->id }}"
                            class="form-checkbox h-5 w-5 text-blue-600 focus:ring-2 focus:ring-blue-500">
                        <label for="layanan_{{ $layanan->id }}"
                            class="ml-2 text-gray-700">{{ ucfirst($layanan->nama_layanan) }} - Rp
                            {{ number_format($layanan->harga_layanan, 0, ',', '.') }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-2 col-span-2">
            <label for="total_harga" class="block font-semibold text-gray-700 mb-2">Total Harga</label>
            <input type="text" id="total_harga" name="total_harga"
                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                value="Rp {{ number_format($total_harga, 0, ',', '.') }}" readonly>
        </div>
        <div class="mt-8 w-full col-span-2">
            <button type="submit"
                class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Buat Reservasi
            </button>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        Livewire.on('success', message => {
            alert(message);
        });
    </script>
@endpush