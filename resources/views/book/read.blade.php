@extends('base_template')

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/turn.min.js') }}" defer></script>

    <style>
        #magazine {
            width: 1152px;
            height: 752px;
        }

        #magazine .turn-page {
            background-color: #ccc;
            background-size: 100% 100%;
        }
    </style>
@endsection

@section('content')
    <div class="flex flex-col items-center bg-gray-100 p-6 mx-auto max-w-6xl min-h-screen">
        @if($book->pages->count() > 0)
            <div id="magazine">
                @foreach($book->pages as $page)
                    <div style="background-image:url({{$page->page_image_url}});"></div>
                @endforeach
            </div>
        @else
            <p class="text-center text-lg font-medium">No pages found for this book.</p>
        @endif
    </div>


    <script type="text/javascript">
        $(window).ready(function () {
            $('#magazine').turn({
                display: 'double',
                acceleration: true,
                gradients: !$.isTouch,
                elevation: 50,
                when: {
                    turned: function (e, page) {
                        /*console.log('Current view: ', $(this).turn('view'));*/
                    }
                },
                page: 1,
            });
        });


        $(window).bind('keydown', function (e) {

            if (e.keyCode == 37)
                $('#magazine').turn('previous');
            else if (e.keyCode == 39)
                $('#magazine').turn('next');

        });

    </script>

@endsection
