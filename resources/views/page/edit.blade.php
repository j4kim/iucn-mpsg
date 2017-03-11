@extends('layout')

@section('title', 'Edition page ' . $page->title)

@section('content')
    <h1>Editing page {{ $page->title }}</h1>
    <form class="form-horizontal" action="{{ route('pages.update', $page->id)}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label class="control-label col-sm-2">Content</label>
            <input name="content" type="hidden">
            <div class="col-sm-10">
                <div class="editor" id="quill">
                    {!! $page->content or "" !!}
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Save</button>

    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/page.edit.js') }}"></script>
@endsection

