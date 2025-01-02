<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Kamar') }}
        </h2>
    </x-slot>

    <div class="w-full h-full mt-8 font-poppins">
        <div class="bg-white  px-12 py-8 rounded-lg flex flex-col">
            <div class="justify-between flex items-center">
                <span class="text-2xl font-bold">Tabel Kelola Kamar</span>
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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Cari nama, nomor kamar..." required />
                            </div>
                        </form>
                    </div>
                    <div>
                        <button type="submit"
                            class="inline-flex items-center py-2 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Kamar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="relative overflow-x-auto pt-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('nomor_kamar')">
                                Nomor Kamar
                                @if ($sort === 'nomor_kamar')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('tipe_kamar')">
                                Tipe Kamar
                                @if ($sort === 'tipe_kamar')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('harga_per_malam')">
                                Harga/Malam
                                @if ($sort === 'harga_per_malam')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('kapasitas')">
                                Kapasitas
                                @if ($sort === 'kapasitas')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('status')">
                                Status
                                @if ($sort === 'status')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kamar as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->nomor_kamar }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->tipe_kamar }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->harga_per_malam }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->kapasitas }} Orang
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->status === 'tersedia')
                                        <span
                                            class=" w-3/5 h-8 justify-center inline-flex items-center px-3 py-4 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                            <svg class="w-5 h-6 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Tersedia
                                        </span>
                                    @elseif ($item->status === 'terisi')
                                        <span
                                            class=" w-3/5 h-8 justify-center inline-flex items-center px-3 py-4 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                                            </svg>

                                            Terisi
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-full">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <button wire:click="delete({{ $item->id }})"
                                        class="bg-red-500 text-white px-4 py-1 rounded">Hapus</button>
                                    <button wire:click="editKamar({{ $item->id }})"
                                        class="bg-blue-700 text-white px-4 py-1 rounded">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <div class="mt-4">
                {{ $kamar->links('components.custom-pagination') }}
            </div>
        </div>
    </div>
</div>