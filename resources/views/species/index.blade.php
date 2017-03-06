@extends('layout')

@section('title', 'List of species')

@section('content')
    <h1>List of species</h1>
    <ul>
    @foreach ($species as $s)
        <li>
            <a href="{{ route('species.show', $s->id) }}">
                {{ $s->name }}
            </a>
        </li>
    @endforeach
    </ul>
@endsection