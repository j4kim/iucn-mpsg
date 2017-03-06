@extends('layout')

@section('title', 'List of islands')

@section('content')
    <h1>List of islands</h1>
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