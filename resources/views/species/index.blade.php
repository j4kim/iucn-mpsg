@extends('layout')

@section('title', 'Species list')

@section('content')
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