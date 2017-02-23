@extends('layout')

@section('title', $species->name)

@section('header')
    <img src="{{ asset('images/' . $species->data["Images"][0]['url'] ) }}">
@endsection

@section('content')
    <div class="row">
        <main class="col-sm-8">
            {!! $species->data["Text"] !!}
        </main>

        <aside class="col-sm-4">


            {{--@foreach($summary as $key => $value)--}}
                {{--<p><strong>{{ $key }}</strong><br>--}}
                {{--{{ $value }}</p>--}}

            {{--@endforeach--}}

            <h3>Summary</h3>
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
                @foreach($summary as $key => $value)
                    <tr>
                        <th>{{ $key }}</th>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @foreach ($species->data["Maps"] as $img)
                <div class="thumbnail species-image">
                    <a href="{{ asset('images/' . $img["url"]) }}">
                        <img class="species-map"
                             src="{{ asset('images/' . $img["url"]) }}"
                             alt="{{ $img["title"] or "Location of " . $species->name }}"
                             title="{{ $img["title"] or "Location of " . $species->name }}">
                    </a>
                </div>
            @endforeach

            <h3>Gallery</h3>
            @foreach ($species->data["Images"] as $img)
                <div class="col-sm-6">
                    <div class="thumbnail species-image">
                        <a href="{{ asset('images/' . $img["url"]) }}">
                            <img src="{{ asset('images/' . $img["url"]) }}" alt="{{ $img["title"] or $species->name }}">
                        </a>
                    </div>
                </div>
            @endforeach


            <h3 style="clear: both">Additionnal references</h3>
            <div class="references">
                {!! $species->data["Additional References"] !!}
            </div>

        </aside>
    </div>

    <p>
        <a href="{{ route('species.edit', $species->id) }}">edit</a>
    </p>
@endsection