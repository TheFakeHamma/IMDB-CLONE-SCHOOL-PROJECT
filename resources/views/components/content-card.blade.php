<div class="mb-4 mx-3">
    <div class="shadow rounded overflow-hidden h-full">
        <div class="relative overflow-hidden">
            @if ($photoUrl)
                <a href="{{ route('content.show', ['id' => $id]) }}">
                    <img src="{{ $photoUrl }}" class="w-full h-2/3 object-cover" alt="{{ $title }}">
                </a>
            @endif
            @if ($averageRating)
                <div class="absolute bottom-0 right-0 m-2 bg-[#82818185] rounded-md px-2 py-1 flex items-center">
                    <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <p class="text-md font-bold text-[#000000]">{{ round((float) $averageRating) }}</p>
                </div>
            @endif
        </div>
        <div class="mt-1">
            <a href="{{ route('content.show', ['id' => $id]) }}"
                class="text-lg text-white font-bold">{{ $title }} ({{ $releaseDate->format('Y') }})</a>
        </div>
    </div>
</div>
