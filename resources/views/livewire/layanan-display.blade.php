<div class="text-white justify-center flex flex-col">
    <div class="flex space-x-4 mb-4 justify-center gap-32 text-xl">
        @foreach(['makanan', 'minuman', 'layanan_tambahan'] as $category)
            <button wire:click.prevent="setCategory('{{ $category }}')" class="px-4 py-2 rounded transition-all duration-300 ease-in-out 
                            {{ $selectedCategory == $category ? ' text-blue-300 border-2 border-blue-300' : 'text-white' }} 
                            hover:text-black hover:border-white hover:bg-white duration-300 hover:duration-500">
                {{ ucfirst($category) == 'Layanan_tambahan' ? 'Addons' : ucfirst($category) }}
            </button>
        @endforeach
    </div>

    <div class="mt-6 transition-opacity duration-500 ease-in-out mx-24"
        x-data="{ selectedCategory: @entangle('selectedCategory') }" x-cloak>
        @foreach(['makanan', 'minuman', 'layanan_tambahan'] as $category)
            <div x-show="selectedCategory === '{{ $category }}'"
                x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="opacity-0 translate-x-5" x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-5">
                <h2 class="text-xl font-semibold mb-4">Layanan
                    {{ ucfirst($category) == 'Layanan_tambahan' ? 'Tambahan' : ucfirst($category) }}
                </h2>
                <div class="grid grid-cols-2 gap-24">
                    @forelse($layanans as $layanan)
                        <div class="border-b py-2 hover:scale-105 duration-300">
                            <div class="flex justify-between items-center">
                                <p class="text-3xl">{{ ucfirst($layanan->nama_layanan) }}</p>
                                <p class="text-2xl font-bold text-blue-300">
                                    {{ 'IDR ' . number_format($layanan->harga_layanan, 0, ',', '.') }}</p>
                            </div>
                            <p>{{ $layanan->deskripsi }}</p>
                        </div>

                    @empty
                        <p>No layanan found in this category.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>