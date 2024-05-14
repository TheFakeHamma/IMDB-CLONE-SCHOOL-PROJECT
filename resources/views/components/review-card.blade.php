<div class="bg-white shadow mt-3 rounded-lg overflow-hidden">
    <div class="bg-gray-100 p-3 flex">
        @for ($i = 0; $i < 5; $i++)
            @if ($i < $review->rating)
                <svg class="w-5 h-5 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.431 8.332 1.209-6.043 5.897 1.427 8.316L12 18.896l-7.384 3.944 1.427-8.316L.587 9.227l8.332-1.209L12 .587z"/></svg>
            @else
                <svg class="w-5 h-5 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.431 8.332 1.209-6.043 5.897 1.427 8.316L12 18.896l-7.384 3.944 1.427-8.316L.587 9.227l8.332-1.209L12 .587z"/></svg>
            @endif
        @endfor
    </div>
    <div class="p-4">
        <blockquote class="mb-0">
            <p class="text-gray-800">{{ $review->review }}</p>
            <footer class="text-sm text-gray-600">
                <cite title="Source Title">
                    @if($review->user)
                        <a href="{{ route('user.profile', $review->user->username) }}" class="text-blue-500 hover:text-blue-600">
                            {{ $review->user->username }}
                        </a>
                    @else
                        User deleted
                    @endif
                </cite>
            </footer>
        </blockquote>
    </div>
</div>
