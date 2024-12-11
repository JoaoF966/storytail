@php use App\Models\Book; @endphp

@extends('base_template')

@section('content')
    @if (!$thisMonthBooks->isEmpty())
        <x-book-list :books="$thisMonthBooks" :title=" (new DateTime())->format('F'). ' featured books'"/>
    @endif

    @if (!$justAddedBooks->isEmpty())
        <x-book-list :books="$justAddedBooks" :title="'Just added'"/>
    @endif

    @if (!$topReadBooks->isEmpty())
        <x-book-list :books="$topReadBooks" :title="'Top read 3 months'"/>
    @endif

    <div class="mt-6" x-data="bookLoader()" x-init="init()">
        <h3 class="uppercase text-base font-semibold ml-1">Our Books</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <template x-for="book in books" :key="book.id">
                <x-book-item :book="new Book()"/>
            </template>
        </div>

        <!-- This div acts as the trigger for loading more books -->
        <div x-ref="loadMoreTrigger" class="h-1"></div>
    </div>
@endsection
