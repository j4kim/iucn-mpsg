@extends('layout')

@section('title', 'List of species')

@section('content')
    <h1>List of species</h1>
    <ul>
    @foreach ($species as $s)
        <li>
            <a href="{{ route('species.show', $s->id) }}"><i>{{ $s->name }}</i></a>

            @if(Auth::check())
                <a href="{{ route('species.edit', $s->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>
            @endif
        </li>
    @endforeach
    </ul>

    @if(Auth::check())
    <p>
        <a class="btn btn-info" href="{{ route('species.create') }}">new</a>
    </p>
    @endif
@endsection