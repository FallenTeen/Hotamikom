<div class="container mx-auto mt-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Reservasi Anda') }}
        </h2>
    </x-slot>

    @if ($reservasi->isEmpty())
        <div class="bg-white my-6 h-12 font-bold text-center flex items-center justify-center rounded-xl mx-8">Anda Belum Memiliki Reservasi</div>
    @else
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nomor Kamar</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Layanan</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Tanggal Check-in</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Tanggal Check-out</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Total Harga</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600 text-center">Rating dan Akhiri Reservasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservasi as $r)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $r->kamar->nomor_kamar }}</td>
                        <td class="px-6 py-4">
                            @foreach ($r->layanan as $layanan)
                                <span>{{ $layanan->nama_layanan }} ({{ $layanan->pivot->jumlah }})</span><br>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">{{ $r->tgl_checkin }}</td>
                        <td class="px-6 py-4">{{ $r->tgl_checkout }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($r->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($r->status == 'approved')
                                <span class="text-green-500">Disetujui</span>
                            @elseif($r->status == 'pending')
                                <span class="text-yellow-500">Menunggu</span>
                            @elseif($r->status == 'canceled')
                                <span class="text-red-500">Dibatalkan</span>
                            @elseif($r->status == 'completed')
                                <span class="text-green-500">Selesai</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 space-y-2 space-x-6">
                            @if($r->review)
                                <!-- Jika sudah ada rating -->
                                <span class="bg-green-500 text-white px-4 py-2 rounded">
                                    Rating: {{ $r->review->rating }}/5
                                </span>
                            @else
                                <!-- Jika belum ada rating -->
                                <button wire:click="openReviewModal({{ $r->id }})"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Tambah Rating
                                </button>



                            @endif

                            <!-- Tombol Akhiri Reservasi -->
                            @if($r->status != 'completed' && $r->tgl_checkout != \Carbon\Carbon::today()->toDateString())
                                <button wire:click="endReservasi({{ $r->id }})"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Akhiri Reservasi
                                </button>
                            @elseif($r->status == 'completed')
                                <span class="text-gray-500">Reservasi Berakhir</span>
                            @endif


                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Modal -->
    @if ($selectedReservasiId)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
                <h2 class="text-lg font-bold mb-4">Tambah Rating</h2>
                <form wire:submit.prevent="submitReview">
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                    <input type="number" id="rating" wire:model="rating" min="1" max="5"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>

                    <label for="komentar" class="block text-sm font-medium text-gray-700 mt-4">Komentar</label>
                    <textarea id="komentar" wire:model="komentar"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        rows="4" required></textarea>

                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400"
                            wire:click="closeReviewModal">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>