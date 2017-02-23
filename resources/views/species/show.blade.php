@extends('layout')

@section('title', $species->name)

@section('content')
    <div class="row">
        <div class="col-sm-12"></div>

        <main class="col-sm-8">
            {!! $species->data["Text"] !!}
        </main>

        <aside class="col-sm-4">

            <table class="table">
                <tbody>
                <tr>
                    <th>Island (Country)</th>
                    <td>
                        @foreach($species->islands as $island)
                            {{ $island->name }} ({{ $island->country }})
                            @if (! $loop->last)
                                -
                            @endif
                        @endforeach
                    </td>
                </tr>
                @foreach($species->data["Summary"] as $key => $value)
                    <tr>
                        <th>{{ $key }}</th>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @foreach ($species->data["Maps"] as $img)
                <img class="species-map"
                     src="{{ asset('images/' . $img["url"]) }}"
                     alt="{{ $img["title"] or "Location of " . $species->name }}"
                     title="{{ $img["title"] or "Location of " . $species->name }}">
            @endforeach

            <h2>Gallery</h2>
            @foreach ($species->data["Images"] as $img)
                <div class="col-sm-6">
                    <div class="thumbnail species-image">
                        <a href="{{ asset('images/' . $img["url"]) }}">
                            <img src="{{ asset('images/' . $img["url"]) }}" alt="{{ $img["title"] or $species->name }}">
                        </a>
                    </div>
                </div>
            @endforeach


            <h2 style="clear: both">Additionnal references</h2>
            <div class="references">
                {!! $species->data["Additional References"] !!}
            </div>

        </aside>
    </div>
    {{--@foreach ($species->data["Images"] as $img)--}}
        {{--<img width="500px"--}}
                {{--src="{{ asset('images/' . $img["url"]) }}"--}}
                {{--alt="{{ $img["title"] or $species->name }}"--}}
                {{--title="{{ $img["title"] or $species->name }}">--}}
    {{--@endforeach--}}





    {{--<h2>Gallery</h2>--}}
    {{--<div class="row">--}}
        {{--@foreach ($species->data["Images"] as $img)--}}
            {{--<div class="col-sm-3">--}}
                {{--<div class="thumbnail">--}}
                    {{--<a href="{{ asset('images/' . $img["url"]) }}">--}}
                        {{--<img src="{{ asset('images/' . $img["url"]) }}" alt="{{ $img["title"] or $species->name }}">--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}

    <p>
        <a href="{{ route('species.edit', $species->id) }}">edit</a>
    </p>
@endsection