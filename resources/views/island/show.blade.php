@extends('layout')

@section('title', $name)

@section('content')
    <h1><a href="{{ route('islands.index') }}">Species by island</a> > {{$name}}</h1>
    @include('island.specieslist')

@endsection