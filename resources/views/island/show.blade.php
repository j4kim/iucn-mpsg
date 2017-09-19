@extends('layout')

@section('title', $name)

@section('content')
    <h1><a href="{{ route('islands.index') }}">Species by island</a> > {{$name}}</h1>
    <ul>
        @foreach($species as $s)
        <li>
            <a  href="{{ route('species.show', $s->id) }}">
                {{$s->name}}
            </a>
        </li>
        @endforeach
    </ul>

@endsection