@extends('layout')

@section('title', $species->name)

@section('header')
    <div class="container">
        <h1 class="title">{{ $species->name }}</h1>
        <img src="{{ $header_img->assetUrl('m') }}">
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

            @foreach ($species->maps as $img)
                <div class="thumbnail">
                    <a href="{{ $img->assetUrl() }}">
                        <img class="species-map"
                             src="{{ $img->assetUrl('s') }}"
                             alt="{{ $img["title"] or "Location of " . $species->name }}"
                             title="{{ $img["title"] or "Location of " . $species->name }}">
                    </a>
                </div>
            @endforeach

            <h2>Gallery</h2>
            <div class="image-gallery">
                @foreach ($species->images as $img)
                    <div class="thumbnail species-image">
                        <a href="{{ $img->assetUrl() }}">
                            <img src="{{ $img->assetUrl('s') }}" alt="{{ $img["title"] or $species->name }}">
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
@endsection


@section('scripts')

    <script src="{{ asset('js/species.show.js') }}"></script>
@endsection