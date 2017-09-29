@extends('layout')

@section('title',"Upload")

@section('content')
    <p></p>
    <form class="form-horizontal" action="{{ route('upload.store')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label class="control-label col-sm-2">Files</label>
            <div class="col-sm-10">
                <div style="margin-top: 7px">
                    <input type="file" id="files-input" name="files[]" multiple>
                </div>
            </div>
        </div>

        <button type="submit" class="col-sm-offset-2 btn btn-primary">Upload</button>

    </form>
    <hr>
@endsection