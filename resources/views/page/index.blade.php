@extends('layout')

@section('title', 'List of pages')

@section('content')
    <h1>Pages</h1>
    <ul>
    @foreach ($pages as $p)
        <li>
            <a href="{{ route('pages.edit', $p->id) }}">
                {{ $p->title }}
            </a>
        </li>
    @endforeach
    </ul>
@endsection