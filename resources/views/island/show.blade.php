@extends('layout')

@section('title', $island->name)

@section('content')
    <h1>{{$island->name}}</h1>
    <ul>
        @foreach($island->species as $s)
        <li>
            <a  href="{{ route('species.show', $s->id) }}">
                {{$s->name}}
            </a>
        </li>
        @endforeach
    </ul>
@endsection