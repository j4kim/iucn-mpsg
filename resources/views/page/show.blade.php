@extends('layout')

@section('title', $page->title)

@section('head')
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
            margin: auto;
            padding:5px 5px 0 5px;
        }
        figure img{
            max-width: 100%;
        }
        figure a, figure a:hover{
            color:#84dcef;
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
                        <a href="{{ route('species.show', $img->species->id) }}">{{ $img->species->name }}</a>
                    </figcaption>
                </figure>
            </div>
        @endforeach
    @endif

    <main class="col-md-8">
        <h1>{{ $page->title }}</h1>
        <div>{!! $page->content !!}</div>
    </main>

    @if(Auth::check())
    <p>
        <a class="btn btn-info" href="{{ route('pages.edit', $page->id) }}">edit</a>
    </p>
    @endif
@endsection

@section('scripts')
    <script>
        $(function(){
            var paragraphs = $('.content p');
            var figures = $('.figure');
            var step = parseInt(paragraphs.length / figures.length);
            console.log(paragraphs.length, figures.length);
            figures.each(function(i,e){
                $(e).insertAfter(paragraphs[i*step]);
            });
        });
    </script>
@endsection