@extends('base_template')

@section('content')
    <div class="flex flex-col items-center bg-gray-100 p-6 mx-auto max-w-6xl min-h-screen">
        <!-- Close  -->
        <div class="flex justify-center w-full mb-4">
            <a href="{{ url('/') }}" class="text-gray-600 text-lg font-bold hover:text-gray-800">
                ✖ CLOSE
            </a>
        </div>

        <!-- Book Pages -->
        <div id="book-pages" class="flex justify-center space-x-4">
            <!-- Left Page -->
            <div>
                <img id="current-page" src=""
                     class="rounded-lg shadow-lg max-w-md">
            </div>

            <!-- Right Page -->
            <div>
                <img id="next-page" src=""
                     alt=""
                     class="rounded-lg shadow-lg max-w-md">
            </div>
        </div>

        <!-- navigation -->
        <div class="flex justify-center items-center mt-6 w-full">
            <div class="flex justify-center items-center space-x-3 mx-auto relative left-5">
                <!-- beginning -->
                <button id="start-btn" class="hover:opacity-80">
                    <img src="{{ asset('images/icons/ffw_l.png') }}" alt="Start" class="w-8 h-8">
                </button>
                <!-- go back -->
                <button id="prev-btn" class="hover:opacity-80">
                    <img src="{{ asset('images/icons/play_l.png') }}" alt="Previous" class="w-8 h-8">
                </button>
                <!-- play/next -->
                <button id="next-btn" class="hover:opacity-80">
                    <img src="{{ asset('images/icons/play_r.png') }}" alt="Next" class="w-8 h-8">
                </button>
                <!-- Fast forward to end -->
                <button id="end-btn" class="hover:opacity-80">
                    <img src="{{ asset('images/icons/ffw_r.png') }}" alt="End" class="w-8 h-8">
                </button>
                <!-- sound -->
                <button id="sound-btn" class="hover:opacity-80">
                    <img src="{{ asset('images/icons/sound.png') }}" alt="Sound" class="w-8 h-8">
                </button>
            </div>
        </div>


        @if($showMovie && $movieFile)
            <div class="flex justify-center mt-6">
                <video controls class="rounded-lg shadow-lg max-w-2xl">
                    <source src="{{ asset($movieFile) }}" type="video/mp4">
                    O teu navegador não suporta o elemento de vídeo.
                </video>
            </div>
        @endif


        <!-- js for navigation and ajax -->
        <script>
            let currentPageNumber = {{ $currentPageNumber }};
            const bookId = "{{ $bookId }}";
            const totalPages = {{ $totalPages }};

            //configurar os botões de navegação
            function setupNavigation() {
                document.getElementById('start-btn')?.addEventListener('click', () => loadPage(1));
                document.getElementById('prev-btn')?.addEventListener('click', () => loadPage(currentPageNumber - 2));
                document.getElementById('next-btn')?.addEventListener('click', () => loadPage(currentPageNumber + 2));
                document.getElementById('end-btn')?.addEventListener('click', () => loadPage(totalPages - 1));
            }

            // AJAX
            function loadPage(page) {
                if (page < 1) page = 1;
                if (page > totalPages) page = totalPages - 1;

                fetch(`/book/${bookId}/load-page/${page}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.currentPageImage) {
                            document.getElementById('current-page').src = data.currentPageImage;
                            document.getElementById('current-page').alt = "Page " + page;

                            if (data.nextPageImage) {
                                document.getElementById('next-page').src = data.nextPageImage;
                                document.getElementById('next-page').alt = "Page " + (page + 1);
                            } else {
                                document.getElementById('next-page').src = '';
                                document.getElementById('next-page').alt = '';
                            }
                        }
                        currentPageNumber = page;
                    })
                    .catch(error => console.error('Error loading pages:', error));
            }

            document.addEventListener('DOMContentLoaded', () => {
                setupNavigation();
                loadPage(1); // Carrega a primeira página automaticamente ao abrir
            });
            setupNavigation();
        </script>
    </div>
@endsection
