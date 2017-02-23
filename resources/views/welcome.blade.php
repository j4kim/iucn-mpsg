@extends('layout')

@section('title', 'Welcome')

@section('content')
    <a href="{{ route('species.index') }}">Species</a>
@endsection