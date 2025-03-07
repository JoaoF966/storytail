<a href="{{ route('book.page', ['id' => $book->id ?? '0'])  }}"
   :href="book.url"
   class="w-72 h-50 relative group mr-4 flex-shrink-0">
    <img :src="book.cover_url" src="{{ $book->cover_url }}" alt="book title" class="w-full h-full object-cover"/>
    <div
        class="hidden group-hover:flex absolute top-0 left-0 right-0 bottom-0 bg-gray-800 bg-opacity-50 flex items-center justify-center text-white">
        <div class="text-center">
            <h3 class="text-lg font-bold" x-text="book.title">{{ $book->title }}</h3>
            <p class="text-sm" x-text="book.author">{{ $book->author }}</p>
        </div>
    </div>
</a>
