<div class="mb-4">
    <div class="bg-white shadow rounded overflow-hidden h-full" style="width: 15rem;">
        @if ($photoUrl)
            <img src="{{ $photoUrl }}" class="w-full h-48 object-cover" alt="{{ $name }}">
        @endif
        <div class="flex flex-col justify-between p-4 h-full">
            <div>
                <h5 class="text-lg font-bold">{{ $name }}</h5>
                <p class="text-sm">
                    {{ strlen($bio) > 100 ? substr($bio, 0, 100) . '...' : $bio }}
                </p>
                @if (isset($role))
                    <footer class="text-gray-600 mt-2 text-sm">Role - {{ $role }}</footer>
                @endif
            </div>
            <div>
                <a href="#" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">More Details</a>
            </div>
        </div>
    </div>
</div>
