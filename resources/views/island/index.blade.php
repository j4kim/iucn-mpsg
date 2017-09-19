@extends('layout')

@section('title', 'List of islands')

@section('content')
    <h1>Species by island</h1>
    <ul>
        @foreach ($islands as $i)
            <li>
                <a href="{{ route('islands.show', $i->id) }}">
                    {{ $i->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection