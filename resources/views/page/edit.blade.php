@extends('layout')

@section('title', 'Edition page ' . $page->title)

@section('content')
    <h1>Editing page {{ $page->title }}</h1>

    <form class="form-horizontal" action="{{ route('pages.update', $page->id)}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label class="control-label col-sm-2">Content</label>
            <div class="col-sm-10">
                <textarea class="editor" name="content">
                    {!! $page->content or "" !!}
                </textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Options</label>
            <div class="col-sm-10">
                <textarea name="options" rows="8">{{ json_encode($page->options, JSON_PRETTY_PRINT) }}</textarea>
                <a href="{{ route('upload.index') }}" target="_blank">Upload tool</a>
            </div>
        </div>

        <p>
            <a class="btn btn-default" href="{{ route('pages.show', strtolower($page->title)) }}">Cancel</a>
        </p>

        <button type="submit" class="btn btn-primary">Save</button>

    </form>

@endsection

@section('head')
    <style>
        textarea{
            font-family: monospace;
            min-width: 100%;
            max-width: 100%;
        }
    </style>
@endsection

@section('scripts')
    <!-- Include editor library -->
    {{--<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=59apqlokg6wupr9euafvyvaek9x93jtnefaylhc80a2jg7hq"></script>--}}
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

    <!-- Initialize editor -->
    <script src="{{ asset('js/page.edit.js') }}"></script>
@endsection
