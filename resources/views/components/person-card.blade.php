<div class="mb-4">
    <div class="bg-white shadow rounded overflow-hidden h-full" style="width: 15rem;">
        @if ($photoUrl)
            <img src="{{ $photoUrl }}" class="w-full h-48 object-cover" alt="{{ $name }}">
        @endif
        <div class="p-4">
            <h5 class="text-lg font-bold">{{ $name }}</h5>
            @if ($bio)
                <p class="text-sm">{{ \Illuminate\Support\Str::limit($bio, 100) }}</p>
            @endif
        </div>
        <div class="bg-gray-100 p-4">
            <a href="{{ route('people.show', ['id' => $id]) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Profile</a>
        </div>
    </div>
</div>
