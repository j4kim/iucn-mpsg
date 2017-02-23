@extends('layout')

@section('title', $species->name . ' edition')

@section('content')
    <form action="{{ route('species.update', $species->id)}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <h2>Summary</h2>

        <p>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{$species->name}}">
        </p>

        <p>
            <label for="latinname">Latin name</label>
            <input type="text" id="latinname" name="Latin_name" value="{{$species->data["Summary"]["Latin name"]}}">
        </p>

        <h2>Text</h2>

        <input name="Text" type="hidden">
        <div id="quillText">
            {!! $species->data["Text"] !!}
        </div>

        <h2>Additional References</h2>

        <input name="Additional_References" type="hidden">
        <div id="quillAddRef">
            {!! $species->data["Additional References"] !!}
        </div>

        <input type="submit">

    </form>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.2.0/quill.min.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var quillText = new Quill('#quillText',{theme: 'snow'});
        var quillAddRef = new Quill('#quillAddRef',{theme: 'snow'});

        var form = document.querySelector('form');
        form.onsubmit = function() {
            var Text = document.querySelector('input[name=Text]');
            Text.value =  document.querySelector('#quillText').children[0].innerHTML;

            var Additional_References = document.querySelector('input[name=Additional_References]');
            Additional_References.value =  document.querySelector('#quillAddRef').children[0].innerHTML;
        }
    </script>

@endsection