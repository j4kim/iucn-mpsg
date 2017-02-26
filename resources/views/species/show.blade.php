@extends('layout')

@section('title', $species->name)

@section('header')
    <div class="container">
        <img src="{{ $header_img_url }}">
    </div>
@endsection

@section('content')
    <div class="row">
        <aside class="col-md-5 col-md-push-7 col-lg-4 col-lg-push-8">

            <h3>Summary</h3>
            <table class="table">
                <tbody>
                @foreach($summary as $key => $value)
                    <tr>
                        <th>{{ $key }}</th>
                        @if(is_string($value))
                            <td><strong>{{ $value }}</strong></td>
                        @elseif(is_array($value))
                            <td><strong><em>{{ $value["Name"] }}</em></strong> {{ $value["Author"] }}</td>
                        @endif
                    </tr>
                @endforeach
                    {{--<tr>--}}
                        {{--<th>Latin name</th>--}}
                        {{--<td><strong><em>{{ $summary['Latin name']['Name'] }}</em></strong> {{ $summary['Latin name']['Author'] }}</td>--}}
                    {{--</tr>--}}
                    {{--@if(isset($summary['Synonym']))--}}
                    {{--<tr>--}}
                        {{--<th>Synonym</th>--}}
                        {{--<td><strong><em>{{ $summary['Synonym']['Name'] }}</em></strong> {{ $summary['Synonym']['Author'] }}</td>--}}
                    {{--</tr>--}}
                    {{--@endif--}}
                </tbody>
            </table>

            @foreach ($species->data["Maps"] as $img)
                <div class="thumbnail">
                    <a href="{{ asset('images/' . $img["url"]) }}">
                        <img class="species-map"
                             src="{{ asset('images/' . $img["url"]) }}"
                             alt="{{ $img["title"] or "Location of " . $species->name }}"
                             title="{{ $img["title"] or "Location of " . $species->name }}">
                    </a>
                </div>
            @endforeach

            <h3>Gallery</h3>
            <div class="image-gallery">
                @foreach ($species->data["Images"] as $img)
                        <div class="thumbnail species-image">
                            <a href="{{ asset('images/' . $img["url"]) }}">
                                <img src="{{ asset('images/' . $img["url"]) }}" alt="{{ $img["title"] or $species->name }}">
                            </a>
                        </div>
                @endforeach
            </div>
            <div style="clear: both"></div>

            <div class="references ref-desktop">
                <h3 style="clear: both">Additionnal references</h3>
                {!! $species->data["Additional References"] !!}
            </div>

        </aside>
        <main class="col-md-7 col-md-pull-5 col-lg-8 col-lg-pull-4">
            {!! $species->data["Text"] !!}
        </main>

    </div>

    <div class="row references ref-mobile">
        <div class="col-md-12">
            <h3 style="clear: both">Additionnal references</h3>
            {!! $species->data["Additional References"] !!}
        </div>
    </div>

    <p>
        <a href="{{ route('species.edit', $species->id) }}">edit</a>
    </p>
@endsection