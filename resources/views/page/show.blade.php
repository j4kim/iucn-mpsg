@extends('layout')

@section('title', $page->title)

@section('head')
    <link rel="stylesheet" href="{{ asset('css/photoswipe/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photoswipe/default-skin/default-skin.css') }}">
    <script src="{{ asset('js/photoswipe/photoswipe.js') }}"></script>
    <script src="{{ asset('js/photoswipe/photoswipe-ui-default.js') }}"></script>

    @if(isset($page->options["stylesheet"]))
        <link rel="stylesheet" href="{{ asset('css') }}/{{ $page->options["stylesheet"] }}">
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
    @if(isset($images))
        <script src="{{ asset('js/gallery.js') }}"></script>
        <script src="{{ asset('js/figures.js') }}"></script>
    @endif
    
    @if(isset($page->options["script"]))
        <script src="{{ asset('js') }}/{{ $page->options["script"] }}"></script>
    @endif
@endsection