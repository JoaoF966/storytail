@extends('base_template')

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
            <div style="margin: 15px 0;">
                <span style="color: #FFD700; font-size: 1.5rem;">★★★★★</span>
                <span style="font-size: 1rem; color: #666;">5/5 (120 ratings)</span>
            </div>

            <!-- Descrição -->
            <p style="line-height: 1.6; color: #333;">
            Lana Rhoades is an American internet personality, podcaster and former pornographic film actress.She has appeared in publications such as Hustler, Penthouse and Playboy.
            </p>
            <p style="line-height: 1.6; color: #333;">
                When that scallywag sets his eye on Rusty, Rodeo Red had better figure out a way to save her best friend in the whole
                world. Can a cowgirl make a bargain with a varmint?
            </p>

            <!-- Botão -->
            <a href="{{route('book.read', ['id' => $id])}}" style="
                display: inline-block;
                padding: 15px 30px;
                background: linear-gradient(to right, #FF6600, #FF0099);
                color: white;
                border-radius: 30px;
                text-decoration: none;
                margin-top: 20px;
                font-size: 1rem;
            ">
                READ NOW
            </a>
        </div>
    </div>

    <!-- Livros Relacionados -->
    <div>
        <h2 style="font-size: 1.8rem; margin-bottom: 20px;">Related Books</h2>
        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <img src="{{ asset('images/Books/book101.png') }}" alt="Book 101" style="width: 100%; border-radius: 8px;">
            </div>
            <div style="flex: 1;">
                <img src="{{ asset('images/Books/book102.png') }}" alt="Book 102" style="width: 100%; border-radius: 8px;">
            </div>
            <div style="flex: 1;">
                <img src="{{ asset('images/Books/book103.png') }}" alt="Book 103" style="width: 100%; border-radius: 8px;">
            </div>
            <div style="flex: 1;">
                <img src="{{ asset('images/Books/book104.png') }}" alt="Book 104" style="width: 100%; border-radius: 8px;">
            </div>
        </div>
    </div>
</div>
@endsection
