@extends('layout')

@section('title',"Upload")

@section('content')
    <h2>Upload new files</h2>
    <form class="form-horizontal" action="{{ route('upload.store')}}"
          method="POST" enctype="multipart/form-data"
    >
        {{ csrf_field() }}

        <div class="form-group">
            <label class="control-label col-sm-2">Files</label>
            <div class="col-sm-10">
                <div style="margin-top: 7px">
                    <input type="file" id="files-input" name="files[]" multiple required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <input type="checkbox" name="resize" > Resize image to <input type="number" name="width" value="1170"> px wide
            </div>
        </div>

        <button type="submit" class="col-sm-offset-2 btn btn-primary">Upload</button>

    </form>

    <h2>Uploaded files</h2>
    <table class="table table-condensed">
        <tr>
            <th>Filename</th>
            <th>Size</th>
            <th>Upload date</th>
            <th>Delete</th>
        </tr>
        @foreach($uploads as $upload)
                <tr>
                    <td>
                        <a target="_blank" href="{{ asset($upload->url) }}">{{ $upload->url }}
                        </a></td>
                    <td>{{ round($upload->size/1024,2) }} MB</td>
                    <td>{{ $upload->created_at }}</td>
                    <td>
                        <form class="upload-delete-form"
                              action="{{ route('upload.destroy', $upload->id)}}"
                              data-filename="{{ $upload->url }}"
                              method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-xs" style="margin: 0">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </form>

                    </td>
                </tr>
        @endforeach
    </table>
@endsection

@section('scripts')
    <script>
        $(".upload-delete-form").submit(function (e) {
            var url = $(this).data("filename");
            if(!confirm(url + "\r\nDelete this file ?")){
                e.preventDefault();
            }
        });
    </script>
@endsection