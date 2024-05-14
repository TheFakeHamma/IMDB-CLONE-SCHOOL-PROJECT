<div
    class="max-w-[15rem]  rounded-lg shadow mx-5 my-3 bg-gray-800 border-gray-700 flex flex-col">
    <a href="{{ route('people.show', ['id' => $id]) }}">
        @if ($photoUrl)
            <img class="rounded-t-lg flex-shrink-0" src="{{ $photoUrl }}" alt="{{ $name }}" />
        @endif
    </a>
    <div class="p-5 flex flex-grow flex-col">
        <a href="{{ route('people.show', ['id' => $id]) }}">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-white">{{ $name }}</h5>
        </a>
        <p class="mb-3 text-md flex-grow font-normal text-gray-400">
            {{ \Illuminate\Support\Str::limit($bio, 30) }}</p>
        <p class="mb-3 text-sm flex-grow font-normal text-gray-400">
            Role - {{ $role }}</p>
        <a href="{{ route('people.show', ['id' => $id]) }}"
            class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
            Read more
            <svg class="ml-2 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
    </div>
</div>
