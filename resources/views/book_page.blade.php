@extends('base_template')
@vite(['resources/js/rating.js'])
@section('content')
<div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
    <!-- Detalhes do Livro -->
    <div style="display: flex; gap: 40px; margin-bottom: 40px;">
        <!-- Imagem do Livro -->
        <div style="flex: 1;">
            <img src="{{ asset('images/Books/book100.png') }}" alt="Rodeo Red" style="width: 100%; border-radius: 8px;">
        </div>

        <!-- Informações do Livro -->
        <div style="flex: 2;">
            <h1 style="font-size: 2.5rem; margin-bottom: 10px;">Rodeo Red</h1>
            <p style="font-size: 1.1rem; color: #FF6600;">From: <strong>João o Rei delas</strong></p>

            <!-- Estrelas e Avaliações -->
            <div class="rating-system">
                <h3 class="text-xl font-semibold mb-2">Rate this book:</h3>
                <div id="rating-stars" class="flex gap-1" data-book-id="{{ $bookId }}">
                    @for ($i = 1; $i <= 5; $i++)
                        <button
                            class="star {{ $i <= ($userRating ?? 0) ? 'text-yellow-400' : 'text-gray-400' }} hover:text-yellow-400 transition duration-300"
                            data-value="{{ $i }}"
                            aria-label="Rate {{ $i }} stars"
                            style="font-size: 1.5rem; background: none; border: none; cursor: pointer;"
                        >
                            ★
                        </button>
                    @endfor
                </div>
                <p id="rating-feedback" class="mt-2 text-sm text-green-500 hidden">Rating submitted!</p>
            </div>

            <!-- Descrição -->
            <p style="line-height: 1.6; color: #333;">
                Lana Rhoades is an American internet personality, podcaster and former pornographic film actress.
                She has appeared in publications such as Hustler, Penthouse and Playboy.
            </p>
            <a href="#" style="
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
</div>
@endsection
