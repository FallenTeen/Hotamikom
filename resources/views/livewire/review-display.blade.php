<div class="space-y-4 bg-white h-72 flex flex-row items-center justify-center">
    @foreach($reviews->take(4) as $review)
        <div class="bg-white shadow-md rounded-lg p-4 w-1/3 mx-32 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div class="font-bold text-lg">{{ $review->user->name }}</div>
                <div class="text-yellow-500">
                    @for($i = 0; $i < 5; $i++)
                        <span class="text-xl {{ $i < $review->rating ? 'text-yellow-400' : 'text-gray-300' }}">&#9733;</span>
                    @endfor
                </div>
            </div>
            <div class="flex-grow mb-4 flex">
                <div class="h-16">
                    <div class="text-gray-700 text-sm line-clamp-3">
                        {{ $review->komentar }}
                    </div>
                </div>
            </div>

            <div class="text-xs text-gray-400 mt-2">
                {{ \Carbon\Carbon::parse($review->tgl_review)->format('d M Y') }}
            </div>
        </div>
    @endforeach
</div>