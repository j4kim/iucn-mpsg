@extends('pdflayout')

@section('title')
    {{ config('app.name') }}
@endsection

@section('back')
    <small><a href="{{ url("/") }}">back</a></small></p>
@endsection

@section('content')
    <div class="first-page break-after">
        <img src="{{ asset('images/iucn_logo.png') }}">
        <h1>TOP 50 Mediterranean Island Plants UPDATE 2017</h1>
    </div>

    @foreach ($pages as $p)
        @include('page.pdfcontent', ['page' => $p])
    @endforeach

    @foreach ($species as $s)
        @include('species.pdfcontent', ['species' => $s])
    @endforeach
@endsection