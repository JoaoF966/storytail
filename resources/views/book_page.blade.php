@extends('base_template')
@vite(['resources/js/rating.js'])
@section('content')
    <div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
        <!-- Detalhes do Livro -->
        <div style="display: flex; gap: 40px; margin-bottom: 40px;">
            <!-- Imagem do Livro -->
            <div style="flex: 1;">
                <img src="/{{ $book->cover_url }}" alt="Rodeo Red"
                     style="width: 100%; border-radius: 8px;">
            </div>

            <!-- Informações do Livro -->
            <div style="flex: 2;">
                <h1 style="font-size: 2.5rem; margin-bottom: 10px;">{{ $book->title }}</h1>
                <p style="font-size: 1.1rem; color: #FF6600;">From:
                    @foreach($book->authors as $author)
                        <strong>{{ $author->first_name . ' ' . $author->last_name  }}</strong>
                    @endforeach
                </p>

                <!-- Estrelas e Avaliações -->
                <div class="rating-system">
                    <div id="rating-stars" class="flex gap-1" data-book-id="{{ $book->id }}">
                        @for ($i = 1; $i <= 5; $i++)
                            <span
                                class="star {{ $i <= $book->averageRating() ? 'text-yellow-400' : 'text-gray-400' }} hover:text-yellow-400 transition duration-300"
                                data-value="{{ $i }}"
                                aria-label="Rate {{ $i }} stars"
                                style="font-size: 1.5rem; background: none; border: none;"
                            >
                                ★
                            </span>
                        @endfor
                    </div>
                    <p id="rating-feedback" class="mt-2 text-sm text-green-500 hidden">Rating submitted!</p>
                </div>

                <!-- Descrição -->
                <p style="line-height: 1.6; color: #333;">
                    {{ $book->description?? 'No description provided.' }}
                </p>
                <a href="{{ route('book.read', ['id' => $book->id]) }}" style="
                display: inline-block;
                padding: 15px 30px;
                background: linear-gradient(to right, #FF6600, #FF0099);
                color: white;
                border-radius: 30px;
                text-decoration: none;
                margin-top: 20px;
                font-size: 1rem;">
                    READ NOW
                </a>
            </div>
        </div>

        @if (!$thisMonthBooks->isEmpty())
            <x-book-list :books="$thisMonthBooks" :title=" (new DateTime())->format('F'). ' featured books'"/>
        @endif
    </div>
@endsection
