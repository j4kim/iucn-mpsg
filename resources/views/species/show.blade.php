@extends('layout')

@section('title', $species->name)

@section('content')
    @foreach ($species->data["Images"] as $img)
        <img
                src="{{ asset('images/' . $img["url"]) }}"
                alt="{{ $img["title"] or $species->name }}"
                title="{{ $img["title"] or $species->name }}">
    @endforeach
    <h1>{{$species->name}}</h1>
    @foreach ($species->data as $key => $value)
        @if (is_string($value))
            <h2>{!! $key !!}</h2>
            <p>{!! $value !!}</p>
        @endif
    @endforeach
@endsection