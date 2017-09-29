@extends('layout')

@section('title',"Upload")

@section('content')
    <form class="form-horizontal" action="{{ route('upload.store')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label class="control-label col-sm-2">Files</label>
            <div class="col-sm-10">
                <div>
                    <label for="files-input" class="form-control btn btn-primary">Add files</label>
                    <input type="file" id="files-input" style="display:none">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>

    </form>
@endsection