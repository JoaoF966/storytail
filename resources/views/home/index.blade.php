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

    <h3 class="uppercase text-base font-semibold ml-1">
        Infinite
    </h3>
@endsection
