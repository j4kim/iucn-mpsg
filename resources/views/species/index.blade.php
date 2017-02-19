@extends('layout')

@section('title', 'Species list')

@section('content')
    <ul>
    @foreach ($species as $s)
        <li>
            <a href="{{ route('species.show', $s->id) }}">
                {{ $s->name }}
                <ul>
                    @foreach($s->Islands as $island)
                        <li>{{$island->name}} ({{$island->country}})</li>
                    @endforeach
                </ul>
            </a>
        </li>
    @endforeach
    </ul>
@endsection