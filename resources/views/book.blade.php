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
        <div style="clear:both;"></div>

        {!! $pages["Home"]->content !!}
    </div>

    <div class="break-before"></div>
    @include('page.pdfcontent', ['page' => $pages["About"]])

    <div class="break-before"></div>


    <h1 class="page-header">The mediterranean Islands</h1>
    <img src="{{ asset('images/Carte-iles-med-3071.jpg') }}">

    @foreach ($species as $s)
        @include('species.pdfcontent', ['species' => $s])
    @endforeach

    <div class="break-before"></div>
    @foreach (["Downloads","Links","Contact"] as $title)
        @include('page.pdfcontent', ['page' => $pages[$title]])
    @endforeach

@endsection