@extends('layout')

@section('title', $page->title)

@section('head')
    @if(isset($images))
        <link rel="stylesheet" href="{{ asset('css/photoswipe/photoswipe.css') }}">
        <link rel="stylesheet" href="{{ asset('css/photoswipe/default-skin/default-skin.css') }}">
        <script src="{{ asset('js/photoswipe/photoswipe.js') }}"></script>
        <script src="{{ asset('js/photoswipe/photoswipe-ui-default.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/figures.css') }}">
    @endif

    @if(isset($page->options["stylesheet"]))
        <link rel="stylesheet" href="{{ asset('css') }}/{{ $page->options["stylesheet"] }}">
    @endif
@endsection

@section('header')
    @if(isset($page->options["header"]))
        <div class="img-header">
            <div class="container">
                <h1 class="title">{{ $page->title }}</h1>
                @php
                    $headers = $page->options["header"];
                    shuffle($headers);
                @endphp
                <img src="{{ $headers[0] }}">
            </div>
        </div>
    @endif

    @if(isset($page->options["background"]))
        @php
            $backgrounds = $page->options["background"];
            shuffle($backgrounds);
        @endphp
        <div class="background background-image" style="background-image: url({{ $backgrounds[0] }})"></div>
        <div class="background background-overlay"></div>
    @endif
@endsection

@section('content')
    @if(isset($images))
        @foreach($images as $img)
            <div class="figure">
                <figure>
                    <a href="{{ imgUrl($img) }}"
                       data-width="{{ $img->width }}"
                       data-height="{{ $img->height }}"
                       data-title="<i>{{ $img->species->name }}</i>"
                       data-link="{{ route("species.show", $img->species->id) }}"
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
        @include("gallery")
    @endif

    <div class="row">
        @if(isset($asidePage))
            <aside class="col-xs-12 col-sm-12 col-md-5 col-lg-4 pull-right">
                <div>{!! $asidePage->content !!}</div>
            </aside>
            <main class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
        @else
            <main class="col-md-12">
        @endif
            {{--S'il y a un header, le titre est dedans--}}
            @if(!isset($page->options["header"]))
                <h1>{{ $page->title }}</h1>
            @else
                <br>
            @endif
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
    @if(isset($images))
        <script src="{{ asset('js/gallery.js') }}"></script>
        <script src="{{ asset('js/figures.js') }}"></script>
    @endif

    @if(isset($page->options["script"]))
        <script src="{{ asset('js') }}/{{ $page->options["script"] }}"></script>
    @endif
@endsection