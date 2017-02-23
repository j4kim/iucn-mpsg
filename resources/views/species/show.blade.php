@extends('layout')

@section('title', $species->name)

@section('content')
    <h1>{{$species->name}}</h1>
    @foreach ($species->data["Images"] as $img)
        <img
                src="{{ asset('images/' . $img["url"]) }}"
                alt="{{ $img["title"] or $species->name }}"
                title="{{ $img["title"] or $species->name }}">
    @endforeach
    <table>
        <tbody>
        @foreach($species->islands as $island)
            {{ $island->name }} ({{ $island->country }})
            @if (! $loop->last)
                -
            @endif
        @endforeach
        </tbody>
            @foreach($species->data["Summary"] as $key => $value)
                <tr>
                    <th>{{ $key }}</th>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $species->data["Text"] !!}
    <h3>Additionnal references</h3>
    {!! $species->data["Additional References"] !!}
@endsection