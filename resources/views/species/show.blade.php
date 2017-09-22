@extends('layout')

@section('title', $species->name)

@section('header')
    <div class="container">
        <h1 class="title">{{ $species->name }}</h1>
        <img src="{{ imgUrl($header_img, 'm') }}">
    </div>
@endsection

@section('content')
    <div class="row">
        <aside class="col-md-5 col-md-push-7 col-lg-4 col-lg-push-8">

            <h2>Summary</h2>
            <table class="table">
                <tbody>
                <?php $summary = $species->data["Summary"]; ?>
                    <tr>
                        <th>Latin name</th>
                        <td><strong><em>{{ $summary['Latin name']['Name'] }}</em></strong> {{ $summary['Latin name']['Author'] }}</td>
                    </tr>
                @if(isset($summary['Synonym']))
                    <tr>
                        <th>Synonym</th>
                        <td><strong><em>{{ $summary['Synonym']['Name'] }}</em></strong> {{ $summary['Synonym']['Author'] }}</td>
                    </tr>
                @endif
                @if(isset($summary['Common name']))
                    <tr>
                        <th>
                        {{-- Plural if there ara multiple common names -> ie. ther is a semicolon --}}
                        @if(strpos($summary["Common name"],';'))
                            Common names
                        @else
                            Common name
                        @endif
                        </th>
                        <td><strong>{{ $summary['Common name'] }}</strong></td>
                    </tr>
                @endif
                @if(isset($summary['Family']))
                    <tr>
                        <th>Family</th>
                        <td><strong>{{ $summary['Family'] }}</strong></td>
                    </tr>
                @endif
                @if(isset($summary['Status']))
                    <tr>
                        <th>Status</th>
                        <td><strong>{{ $summary['Status'] }}</strong></td>
                    </tr>
                @endif
                <tr>
                    @if(count($species->islands) === 1)
                        <th>Island</th>
                    @else
                        <th>Islands</th>
                    @endif
                    <td>
                        <ul class="island-list">
                            @foreach($species->islands as $isl)
                                <li><a href="{{ route('islands.show', $isl->id) }}"><strong>{{ $isl->name }}</strong> ({{ $isl->country }})</a></li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="maps-container">
                @foreach ($species->maps as $img)
                    <div class="species-map">
                        <a href="{{ imgUrl($img) }}"
                           data-width="{{ $img->width }}"
                           data-height="{{ $img->height }}"
                           data-title="{{ $img["title"] }}"
                           data-legend="{{ $img["legend"] }}"
                        >
                            <img
                                    src="{{ imgUrl($img, 's') }}"
                                    alt="{{ $img["title"] or "Location of " . $species->name }}"
                                    title="{{ $img["title"] or "Location of " . $species->name }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <h2>Gallery</h2>
            <div class="image-gallery grid">
                <div class="grid-sizer"></div>
                @foreach ($species->images as $img)
                    <div class="species-image grid-item">
                        <a href="{{ imgUrl($img) }}"
                           data-width="{{ $img->width }}"
                           data-height="{{ $img->height }}"
                           data-title="{{ $img["title"] }}"
                           data-legend="{{ $img["legend"] }}"
                        >
                            <img src="{{ imgUrl($img, 's') }}" alt="{{ $img["title"] or $species->name }}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div style="clear: both"></div>

            @if($species->data["Additional References"] != "<p><br></p>")
                <div class="references ref-desktop">
                    <h2 style="clear: both">Additional references</h2>
                    {!! $species->data["Additional References"] !!}
                </div>
            @endif
        </aside>

        <main class="col-md-7 col-md-pull-5 col-lg-8 col-lg-pull-4">
            {!! $species->data["Text"] !!}
        </main>

    </div>

    @if($species->data["Additional References"] != "<p><br></p>")
        <div class="row references ref-mobile">
            <div class="col-md-12">
                <h2 style="clear: both">Additional references</h2>
                {!! $species->data["Additional References"] !!}
            </div>
        </div>
    @endif



    <a href="{{ route('species.pdf', $species->id) }}" style="font-size: 0.8em">Printable version</a>

    @if(Auth::check())
        <p>
            <a class="btn btn-info" href="{{ route('species.edit', $species->id) }}">edit</a>
        </p>
    @endif

    @include("gallery")
@endsection


@section('head')
    <link rel="stylesheet" href="{{ asset('css/photoswipe/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photoswipe/default-skin/default-skin.css') }}">
    <script src="{{ asset('js/photoswipe/photoswipe.js') }}"></script>
    <script src="{{ asset('js/photoswipe/photoswipe-ui-default.js') }}"></script>

    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
@endsection


@section('scripts')
    <script src="{{ asset('js/species.show.js') }}"></script>
@endsection