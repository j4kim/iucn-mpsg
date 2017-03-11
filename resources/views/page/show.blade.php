@extends('layout')

@section('title', $page->title)

@section('content')
    <h1>{{ $page->title }}</h1>
    <div>{!! $page->content !!}</div>

    @if(Auth::check())
    <p>
        <a class="btn btn-info" href="{{ route('pages.edit', $page->id) }}">edit</a>
    </p>
    @endif
@endsection