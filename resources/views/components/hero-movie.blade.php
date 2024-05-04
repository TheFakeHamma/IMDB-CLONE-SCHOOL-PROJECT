<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-5">
    <div class="flex flex-wrap bg-white p-4 md:pt-5 rounded-lg shadow-lg">
        <div class="w-full lg:w-1/3 overflow-hidden shadow-lg">
            <div>{{ $slot }}</div>
        </div>
        <div class="w-full lg:w-2/3 p-3 lg:pl-5 lg:pt-3">
            <h2 class="font-bold text-4xl">{{ $title }}</h2>
            <p class="text-lg mt-2">{{ $synopsis }}</p>
            <footer class="mt-2 text-gray-600">Release date {{ $releaseDate->format('Y') }}</footer>
            <div class="mt-4 flex space-x-2">
                <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" href="{{ route('content.show', ['id' => $id]) }}" role="button">Go to movie</a>
            </div>
        </div>
    </div>
</div>
