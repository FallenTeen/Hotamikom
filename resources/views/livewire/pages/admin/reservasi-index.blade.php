<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Layanan') }}
        </h2>
    </x-slot>

    <div class="w-full h-full mt-8 font-poppins">
        <div class="bg-white  px-12 py-8 rounded-lg flex flex-col">
            <div class="justify-between flex items-center">
                <span class="text-2xl font-bold">Tabel Kelola Reservasi</span>
                <div class="w-2/4 flex items-center justify-end gap-2">
                    <div class="w-1/2">
                        <form class="flex items-center">
                            <label for="voice-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" wire:model.live.debounce.500ms="cari"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Cari Reservasi" required />
                            </div>
                        </form>
                    </div>
                    <div>
                        <button type="button" wire:click="createRsv"
                            class="inline-flex items-center py-2 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Reservasi Manual
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="relative overflow-x-auto pt-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-2 py-3 cursor-pointer">
                                Nama Reservant
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer">
                                Nomor Kamar
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer">
                                Layanan yang dipakai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Check-in
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Check-out
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Tagihan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status Reservasi
                            </th>
                            <th scope="col" class="px-6 py-3 justify-center flex items-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservasis as $rsv)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $rsv->user->name }}
                                </td>
                                <td
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center justify-between">
                                    <span class="font-bold"> {{ $rsv->kamar->nomor_kamar }}</span>
                                    <span class="font-light">({{ $rsv->kamar->tipe_kamar }})</span>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @foreach($rsv->layanan as $layanan)
                                        <div>{{ $layanan->nama_layanan }}</div>
                                    @endforeach
                                </td>
                                <td
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ \Carbon\Carbon::parse($rsv->tgl_checkin)->format('d-m-Y') }}
                                </td>
                                <td
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ \Carbon\Carbon::parse($rsv->tgl_checkout)->format('d-m-Y') }}
                                </td>
                                <td
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ number_format($rsv->total_tagihan, 0, ',', '.') }}
                                </td>
                                <td
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $rsv->status }}
                                </td>
                                <td class="px-6 py-4 text-center flex">
                                    <button wire:click="delete({{ $rsv->id }})"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none ml-2">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="mt-4">
                {{ $reservasis->links() }}
            </div>
        </div>
    </div>
</div>