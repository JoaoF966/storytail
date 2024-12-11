<div class="mt-6">
    <h3 class="uppercase text-base font-semibold ml-1">
        {{ $title }}
    </h3>
    <div class="flex flex-row w-100 overflow-x-auto">
        @foreach($books as $book)
            <x-book-item :book="$book"/>
        @endforeach
    </div>
</div>
