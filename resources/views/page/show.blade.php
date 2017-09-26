@extends('layout')

@section('title', $page->title)

@section('head')
    <link rel="stylesheet" href="{{ asset('css/photoswipe/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photoswipe/default-skin/default-skin.css') }}">
    <script src="{{ asset('js/photoswipe/photoswipe.js') }}"></script>
    <script src="{{ asset('js/photoswipe/photoswipe-ui-default.js') }}"></script>

    <style>
        p{
            /*text-align: justify;*/
        }
        .figure{
            margin-bottom: 10px;
        }
        figure{
            background-color: #333;
            width:330px;
            max-width: 100%;
            margin: auto;
            padding:5px 5px 0 5px;
        }
        figure img{
            max-width: 100%;
        }
        .figure a, .figure a:hover{
            color:#84dcef;
            /*color:white;*/
        }
    </style>
@endsection

@section('content')

    @if(isset($images))
        @foreach($images as $img)
            <div class="figure">
                <figure>
                    <a href="{{ imgUrl($img) }}"
                       data-width="{{ $img->width }}"
                       data-height="{{ $img->height }}"
                       data-title="{{ $img["title"] }}"
                       data-legend="{{ $img["legend"] }}"
                    >
                        <img src="{{ imgUrl($img, 's') }}" alt="{{ $img["title"] or $img->species->name }}">
                    </a>
                    <figcaption>
                        <a href="{{ route('species.show', $img->species->id) }}">
                            <i>{{ $img->species->name }}</i>
                        </a>
                    </figcaption>
                </figure>
            </div>
        @endforeach
    @endif

    <div class="row">
        @if(isset($asidePage))
            <aside class="col-xs-12 col-sm-12 col-md-5 col-lg-4 pull-right">
                <div>{!! $asidePage->content !!}</div>
            </aside>
        @endif

        <main class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
            <h1>{{ $page->title }}</h1>
            <div>{!! $page->content !!}</div>
        </main>
    </div>

    @if(Auth::check())
    <p>
        <a class="btn btn-info" href="{{ route('pages.edit', $page->id) }}">edit</a>
    </p>
    @endif

    @include("gallery")
@endsection

@section('scripts')
    <script src="{{ asset('js/gallery.js') }}"></script>
    <script>
        $(function(){
            var paragraphs = $('main p');
            var figures = $('.figure');
            var step = parseInt(paragraphs.length / figures.length);
            console.log(paragraphs.length, figures.length);
            figures.each(function(i,e){
                $(e).insertAfter(paragraphs[i*step]);
            });

            createGallery($("figure > a"), true);
        });
    </script>
@endsection