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
            max-width: 100%;
            margin: auto;
            padding:5px 5px 0 5px;
        }
        figure img{
            max-width: 100%;
        }
        .figure a, .figure a:hover{
            /*color:#84dcef;*/
            color:white;
        }
    </style>
@endsection

@section('content')

    @if(isset($images))
        @foreach($images as $img)
            <div class="figure">
                <a href="{{ route('species.show', $img->species->id) }}">
                <figure>
                        <img src="{{ imgUrl($img, 's') }}" alt="{{ $img["title"] or $img->species->name }}">
                    <figcaption>
                        {{ $img->species->name }}
                    </figcaption>
                </figure>
                </a>
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
@endsection

@section('scripts')
    <script>
        $(function(){
            var paragraphs = $('main p');
            var figures = $('.figure');
            var step = parseInt(paragraphs.length / figures.length);
            console.log(paragraphs.length, figures.length);
            figures.each(function(i,e){
                $(e).insertAfter(paragraphs[i*step]);
            });
        });
    </script>
@endsection