@extends('pdflayout')

@section('title')
    {{ $species->name }}
@endsection

@section('back')
    <small><a href="{{ route("species.show", $species->id) }}">back</a></small></p>
@endsection

@section('content')
    @include('species.pdfcontent')
@endsection