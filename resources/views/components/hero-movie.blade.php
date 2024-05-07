<div class="bg-[#252525] h-30 rounded-sm shadow-lg flex items-center justify-between mx-auto my-5">
    <div class="w-2/5">
        <div>{{ $slot }}</div>
    </div>
    <div class="w-2/3 p-3 md:pl-5 text-white mx-20">
        <div class="flex">
        <h2 class="text-2xl font-bold">{{ $title }}</h2>
        <div class="flex items-center mt-2 ml-5">
            @for ($i = 0; $i < 5; $i++)
                <svg class="{{ $i < round($averageRating) ? 'text-yellow-400' : 'text-gray-500' }} w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M10 15l-5.5 3 1.5-6.6L0 7.6l6.4-1L10 0l3.6 6.6 6.4 1-4.6 4.4 1.5 6.6z"/>
                </svg>
            @endfor
            <span class="ml-2 text-sm text-gray-400">{{ $averageRating }} / 5</span>
        </div>
    </div>
        <p class="mt-4">{{ $synopsis }}</p>
        <a href="{{ route('content.show', ['id' => $id]) }}" class="text-[#FFFFFF] font-bold hover:text-[#FF3131] mt-10 inline-block">Read More...</a>
    </div>
</div>
