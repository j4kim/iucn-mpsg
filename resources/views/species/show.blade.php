@extends('layout')

@section('title', $species->name)

@section('content')
    <h1>{{$species->name}}</h1>
    <a href="{{ route('species.edit', $species->id) }}">edit</a>

    @foreach ($species->data["Images"] as $img)
        <img width="500px"
                src="{{ asset('images/' . $img["url"]) }}"
                alt="{{ $img["title"] or $species->name }}"
                title="{{ $img["title"] or $species->name }}">
    @endforeach
    <div>
        <table>
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
            <img width="500px"
                 src="{{ asset('images/' . $img["url"]) }}"
                 alt="{{ $img["title"] or "Location of " . $species->name }}"
                 title="{{ $img["title"] or "Location of " . $species->name }}">
        @endforeach
    </div>
    {!! $species->data["Text"] !!}
    <h3>Additionnal references</h3>
    {!! $species->data["Additional References"] !!}
@endsection