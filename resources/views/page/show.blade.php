@extends('layout')

@section('title', $page->title)

@section('head')
    <style>
        p{
            /*text-align: justify;*/
        }
        figure{
            padding: 10px;
            text-align: center;
            /*background-color: #eee;*/
        }
    </style>
@endsection

@section('content')

    @if(isset($images))
        @foreach($images as $img)
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
            var images = $('figure');
            var step = parseInt(paragraphs.length / images.length);
            console.log(paragraphs.length, images.length);
            images.each(function(i,e){
                $(e).insertAfter(paragraphs[i*step]);
            });
        });
    </script>
@endsection