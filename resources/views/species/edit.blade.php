@extends('layout')

@section('title', 'Edition species ' . $species->name)

@section('content')
        <form class="form-horizontal" action="{{ route('species.update', $species->id)}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
                <label class="control-label col-sm-2" for="Latin_name">Latin name</label>
                <div class=" col-sm-5">
                    <input class="form-control" type="text" id="Latin_name" name="Latin_name" value="{{$species->data["Summary"]["Latin name"]["Name"] or "" }}">
                </div>
                <label class="control-label col-sm-1" for="Latin_name_Author">Author</label>
                <div class=" col-sm-4">
                    <input class="form-control" type="text" id="Latin_name_Author" name="Latin_name_Author" value="{{$species->data["Summary"]["Latin name"]["Author"] or ""  }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="Synonym">Synonym</label>
                <div class=" col-sm-5">
                    <input class="form-control" type="text" id="Synonym" name="Synonym" value="{{ $species->data["Summary"]["Synonym"]["Name"] or "" }}">
                </div>
                <label class="control-label col-sm-1" for="Synonym_Author">Author</label>
                <div class=" col-sm-4">
                    <input class="form-control" type="text" id="Synonym_Author" name="Synonym_Author" value="{{$species->data["Summary"]["Synonym"]["Author"] or ""}}">
                </div>
            </div>

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
                    @foreach($species->data['Images'] as $n => $img)
                        <div class="image-edit row">
                            <div class="col-sm-4">
                                <img src="{{ asset('images/' . $img["url"]) }}" width="100%">
                            </div>
                            <div class="col-sm-8">
                                <p>
                                    <label class="control-label" for="title-image-{{ $n }}">Title</label>
                                    <div class="">
                                        <input class="form-control" type="text" id="title-image-{{ $n }}" name="Image_Name_{{$n}}" value="{{ $img["title"] or "" }}">
                                    </div>
                                    <label class="control-label" for="legend-image-{{ $n }}">Legend</label>
                                    <div class="">
                                        <input class="form-control" type="text" id="legend-image-{{ $n }}" name="Image_Legend_{{$n}}" value="{{ $img["legend"] or "" }}">
                                    </div>
                                </p>
                                <p>
                                    <button class="btn btn-danger">Remove</button>
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <div>
                        <label for="image-input" class="form-control btn btn-primary">Add image</label>
                        <input type="file" id="image-input" accept="image/*" name="image_0" style="display:none">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Maps</label>
                <div class="col-sm-10">
                    @foreach($species->data['Maps'] as $n => $img)
                        <div class="image-edit row">
                            <div class="col-sm-4">
                                <img src="{{ asset('images/' . $img["url"]) }}" width="100%">
                            </div>
                            <div class="col-sm-8">
                                <p>
                                    <label class="control-label" for="title-map-{{ $n }}">Title</label>
                                <div class="">
                                    <input class="form-control" type="text" id="title-map-{{ $n }}" name="Map_Name_{{$n}}" value="{{ $img["title"] or "" }}">
                                </div>
                                <label class="control-label" for="legend-map-{{ $n }}">Legend</label>
                                <div class="">
                                    <input class="form-control" type="text" id="legend-map-{{ $n }}" name="Map_Legend_{{$n}}" value="{{ $img["legend"] or "" }}">
                                </div>
                                </p>
                                <p>
                                    <button class="btn btn-danger">Remove</button>
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        <label for="map-input" class="form-control btn btn-primary">Add map image</label>
                        <input type="file" id="map-input" accept="image/*" name="map_0" style="display:none">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Text</label>
                <input name="Text" type="hidden">
                <div class="col-sm-10">
                    <div class="editor" id="quillText">
                        {!! $species->data["Text"] or "" !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Additional References</label>
                <input name="Additional_References" type="hidden">
                <div class="col-sm-10">
                    <div class="editor" id="quillAddRef">
                        {!! $species->data["Additional References"] or "" !!}
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>

        </form>

@endsection

@section('scripts')
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.2.0/quill.min.js"></script>
    <!-- Initialize Quill editors -->
    <script src="{{ asset('js/species.edit.js') }}"></script>
@endsection

