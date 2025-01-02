<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Layanan') }}
        </h2>
    </x-slot>

    <div class="w-full h-full mt-8 font-poppins">
        <div class="bg-white  px-12 py-8 rounded-lg flex flex-col">
            <div class="justify-between flex items-center">
                <span class="text-2xl font-bold">Tabel Kelola Layanan</span>
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
                                    placeholder="Cari Layanan" required />
                            </div>
                        </form>
                    </div>
                    <div>
                        <button type="button" wire:click="showCreate"
                            class="inline-flex items-center py-2 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Layanan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="relative overflow-x-auto pt-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('nama_layanan')">
                                Nama Layanan
                                @if ($sort === 'nama_layanan')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif

                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('harga_layanan')">
                                Harga Layanan
                                @if ($sort === 'harga_layanan')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('tgl_layanan')">
                                Tanggal Layanan
                                @if ($sort === 'tgl_layanan')
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
                        @forelse($layanans as $lay)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $lay->nama_layanan }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $lay->harga_layanan }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $lay->tgl_layanan }}
                                </td>
                                <td class="px-6 py-4">
                                    <button wire:click="showEdit({{ $lay->id }})"
                                        class="bg-blue-700 text-white px-4 py-1 rounded">Edit</button>
                                    <button wire:click="delete({{ $lay->id }})"
                                        class="bg-red-500 text-white px-4 py-1 rounded">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>
            <div class="mt-4">
                {{ $layanans->links() }}
            </div>
        </div>
    </div>
    @if($showCreateModal || $showEditModal)
        <div class="fixed inset-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-6 w-1/3">
                <h2 class="text-xl font-semibold mb-4">{{ $showCreateModal ? 'Tambah Layanan' : 'Edit Layanan' }}</h2>
                <form wire:submit.prevent="{{ $showCreateModal ? 'createLayanan' : 'updateLayanan' }}">
                    <div class="mb-4">
                        <label for="nama_layanan" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                        <input type="text" wire:model="nama_layanan" id="nama_layanan" class="w-full p-2 border rounded">
                        @error('nama_layanan') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="harga_layanan" class="block text-sm font-medium text-gray-700">Harga Layanan</label>
                        <input type="number" wire:model="harga_layanan" id="harga_layanan"
                            class="w-full p-2 border rounded">
                        @error('harga_layanan') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="tgl_layanan" class="block text-sm font-medium text-gray-700">Tanggal Layanan</label>
                        <input type="date" wire:model="tgl_layanan" id="tgl_layanan" class="w-full p-2 border rounded">
                        @error('tgl_layanan') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded">Tutup</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded ml-2">{{ $showCreateModal ? 'Tambah' : 'Update' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>