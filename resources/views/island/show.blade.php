@extends('layout')

@section('title', $name)

@section('content')
    <h1>{{$name}}</h1>
    <ul>
        @foreach($species as $s)
        <li>
            <a  href="{{ route('species.show', $s->id) }}">
                {{$s->name}}
            </a>
        </li>
        @endforeach
    </ul>
    <a href="{{ route('islands.index') }}">◀ Species by island</a>
@endsection