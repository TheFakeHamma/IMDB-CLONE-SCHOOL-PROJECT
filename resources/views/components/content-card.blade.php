<div class="mb-4">
    <div class="bg-white shadow rounded overflow-hidden h-full" style="width: 15rem;">
        @if ($photoUrl)
            <img src="{{ $photoUrl }}" class="w-full h-48 object-cover" alt="{{ $title }}">
        @endif
        <div class="flex flex-col justify-between p-4 h-full">
            <div>
                <h5 class="text-lg font-bold">{{ $title }}</h5>
                <footer class="text-gray-600 mt-2">Release date {{ $releaseDate->format('Y') }}</footer>
                @if ($averageRating)
                    <div class="flex mt-2">
                        @for ($i = 0; $i < 5; $i++)
                            @if (is_numeric($averageRating) && $i < round($averageRating))
                                <svg class="w-4 h-4 fill-current text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.5 3 1.5-5.5L0 8h5.6L10 3l3.4 5H19l-5 4.5 1.5 5.5z"/></svg>
                            @else
                                <svg class="w-4 h-4 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.5 3 1.5-5.5L0 8h5.6L10 3l3.4 5H19l-5 4.5 1.5 5.5z"/></svg>
                            @endif
                        @endfor
                    </div>
                @endif
            </div>
            <div>
                <a href="{{ route('content.show', ['id' => $id]) }}" class="inline-block mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">More Details</a>
            </div>
        </div>
    </div>
</div>
