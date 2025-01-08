@php
    use Illuminate\Support\Facades\Storage;
@endphp

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Kamar') }}
        </h2>
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('message') }}
            </div>
        @endif
    </x-slot>

    <div class="w-full h-full mt-8 font-poppins">
        <div class="bg-white px-12 py-8 rounded-lg flex flex-col">
            <div class="justify-between flex items-center">
                <span class="text-2xl font-bold">Tambahkan Kamar Baru</span>
            </div>

            <form wire:submit.prevent="save">
                <div class="grid grid-cols-3 gap-4 items-center mb-8">
                    <!-- Gambar -->
                    <div class=" col-span-1 flex justify-center items-center">

                        <div class="flex flex-row items-center justify-center w-full">

                            @if ($gambar)
                                <div class="mt-4">
                                    <img src="{{ $gambar->temporaryUrl() }}" class="w-full h-full object-cover rounded-md"
                                        alt="Image preview">
                                </div>
                            @else
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" class="hidden" wire:model="gambar" />
                                </label>
                            @endif
                        </div>

                        @error('gambar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Form Input -->
                    <div class="col-span-2">
                        <div class="mb-4">
                            <label for="nomor_kamar" class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
                            <input type="text" id="nomor_kamar" wire:model="nomor_kamar"
                                class="w-full mt-2 p-2 border border-gray-300 rounded-lg" />
                            @error('nomor_kamar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-8 w-full">
                            <div class="mb-4 w-1/2">
                                <label for="tipe_kamar" class="block text-sm font-medium text-gray-700">Tipe
                                    Kamar</label>
                                <select id="tipe_kamar" wire:model="tipe_kamar"
                                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
                                    <option value="">Pilih Opsi</option>
                                    <option value="vip">VIP</option>
                                    <option value="reguler">Reguler</option>
                                </select>
                                @error('tipe_kamar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4 w-1/2">
                                <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                <input type="number" id="kapasitas" wire:model="kapasitas"
                                    class="w-full mt-2 p-2 border border-gray-300 rounded-lg" />
                                @error('kapasitas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="harga_per_malam" class="block text-sm font-medium text-gray-700">Harga Per
                                Malam</label>
                            <input type="number" id="harga_per_malam" wire:model="harga_per_malam"
                                class="w-full mt-2 p-2 border border-gray-300 rounded-lg" />
                            @error('harga_per_malam') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="w-full flex-col">
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" wire:model="status"
                            class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
                            <option value="">Pilih Ketersediaan</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="terisi">Terisi</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="deskripsi" wire:model="deskripsi"
                            class="w-full mt-2 p-2 border border-gray-300 rounded-lg"></textarea>
                        @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-8 mt-6">
                    <div>
                        <button type="button"
                            class="px-4 py-2 bg-gray-300 text-white rounded-lg hover:bg-gray-400">Batal</button>
                    </div>
                    <div>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>