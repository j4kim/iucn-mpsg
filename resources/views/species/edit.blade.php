@extends('layout')

@section('title', 'Edition species ' . $species->name)

@section('content')
    <p>
        <a class="btn btn-default" href="{{ route('species.show', $species->id) }}">Cancel</a>
    </p>

        <form id="species-edit-form" class="form-horizontal" action="{{ route('species.update', $species->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
                <label class="control-label col-sm-2" for="Latin_name">Latin name</label>
                <div class=" col-sm-5">
                    <input class="form-control" type="text" id="Latin_name" name="Latin_name" value="{{$species->data["Summary"]["Latin name"]["Name"] or "" }}" required>
                </div>
                <label class="control-label col-sm-1" for="Latin_name_Author">Author</label>
                <div class=" col-sm-4">
                    <input class="form-control" type="text" id="Latin_name_Author" name="Latin_name_Author" value="{{$species->data["Summary"]["Latin name"]["Author"] or ""  }}">
                </div>
            </div>

            @if(count($species->data["Summary"]["Synonyms"]))
                @foreach($species->data["Summary"]["Synonyms"] as $syn)
                    <div class="form-group">
                        <label class="control-label col-sm-2">Synonym</label>
                        <div class=" col-sm-5">
                            <input class="form-control" type="text" name="Synonyms[]" value="{{ $syn["Name"] or "" }}">
                        </div>
                        <label class="control-label col-sm-1">Author</label>
                        <div class=" col-sm-4">
                            <input class="form-control" type="text" name="Synonym_Authors[]" value="{{$syn["Author"] or ""}}">
                        </div>
                    </div>
                @endforeach
            @else
                <div class="form-group">
                    <label class="control-label col-sm-2">Synonym</label>
                    <div class=" col-sm-5">
                        <input class="form-control" type="text" name="Synonyms[]" value="">
                    </div>
                    <label class="control-label col-sm-1">Author</label>
                    <div class=" col-sm-4">
                        <input class="form-control" type="text" name="Synonym_Authors[]" value="">
                    </div>
                </div>
            @endif

            <p class="help-block  col-sm-offset-2"><a href="#" id="add-syn-btn">Add synonym</a></p>

            <div class="form-group">
                <label class="control-label col-sm-2" for="Common_name" id="Common_name_label">Common name</label>
                <div class=" col-sm-10">
                    <input class="form-control" type="text" id="Common_name" name="Common_name" value="{{ $species->data["Summary"]["Common name"] or "" }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="Family">Family</label>
                <div class=" col-sm-10">
                    <input class="form-control" type="text" id="Family" name="Family" value="{{ $species->data["Summary"]["Family"] or "" }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="Status">Status</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="Status" name="Status" value="{{ $species->data["Summary"]["Status"] or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Islands</label>
                <div class="col-sm-10">
                    @foreach($islands as $island)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       name="islands[]"
                                       value="{{ $island->id }}"
                                       @if(in_array($island->id, $species_islands))
                                           checked
                                       @endif
                                >
                                {{ $island->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Images</label>
                <div class="col-sm-10">
                    <div id="images-img">
                        @foreach($species->images as $img)
                            <div class="template-placeholder"
                                 data-image-id="{{ $img->id }}"
                                 data-image-legend="{{ $img->legend }}"
                                 data-image-title="{{ $img->title }}"
                                 data-image-url="{{ imgUrl($img,'s') }}"
                                 data-image-type="img"
                            >
                                This need to be replaced by the image template
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <label for="image-input" class="form-control btn btn-primary">Add image</label>
                        <input type="file" id="image-input" accept="image/*" style="display:none">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Maps</label>
                <div class="col-sm-10">
                    <div id="images-map">
                        @foreach($species->maps as $img)
                            <div class="template-placeholder"
                                 data-image-id="{{ $img->id }}"
                                 data-image-legend="{{ $img->legend }}"
                                 data-image-title="{{ $img->title }}"
                                 data-image-url="{{ imgUrl($img,'s') }}"
                                 data-image-type="map"
                            >
                                This need to be replaced by the image template
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <label for="map-input" class="form-control btn btn-primary">Add map image</label>
                        <input type="file" id="map-input" accept="image/*" style="display:none">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Text</label>
                <div class="col-sm-10">
                    <textarea name="Text" class="editor" id="editorText">
                        {!! $species->data["Text"] or "" !!}
                    </textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Additional References</label>
                <div class="col-sm-10">
                    <textarea name="Additional_References" class="editor" id="editorAddRef">
                        {!! $species->data["Additional References"] or "" !!}
                    </textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>

        </form>

        <form id="species-delete-form" action="{{ route('species.destroy', $species->id)}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        @include('species.image_template')
@endsection

@section('scripts')
    <!-- Include editor library -->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=59apqlokg6wupr9euafvyvaek9x93jtnefaylhc80a2jg7hq"></script>

    <!-- Handlebars -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js" integrity="sha256-0JaDbGZRXlzkFbV8Xi8ZhH/zZ6QQM0Y3dCkYZ7JYq34=" crossorigin="anonymous"></script>

    <script src="{{ asset('js/species.edit.js') }}"></script>
@endsection

