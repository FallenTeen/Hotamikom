@if ($paginator->hasPages())
    <nav class="flex justify-between items-center" aria-label="Pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-200 rounded cursor-not-allowed">
                &larr; Sebelumnya
            </span>
        @else
            <button wire:click="previousPage"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded hover:bg-gray-100">
                &larr; Sebelumnya
            </button>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2 text-sm font-medium text-gray-400">{{ $element }}</span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 text-sm font-medium text-white bg-blue-500 border rounded">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded hover:bg-gray-100">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded hover:bg-gray-100">
                Berikutnya &rarr;
            </button>
        @else
            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-200 rounded cursor-not-allowed">
                Berikutnya &rarr;
            </span>
        @endif
    </nav>
@endif