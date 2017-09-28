@extends('layout')

@section('title', 'List of islands')

@section('head')
    <style>
        main img {
            margin: 20px 0;
        }
        .bold{
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <h1>Species by island</h1>
    <div class="row">
        <main class="col-md-12">
            <ul>
                @foreach ($islands as $i)
                    <li>
                        <a class="list-link list-link-{{ $i->id }}" href="{{ route('islands.show', $i->id) }}">
                            {{ $i->name }}
                        </a>
                        <div class="hidden">
                            @include('island.specieslist', ['species' => $i->species])
                        </div>
                    </li>
                @endforeach
            </ul>
            <a class="medi-map" href="{{ asset('images/Carte-iles-med-3071.jpg') }}" data-width="3071" data-height="1577">
                <img src="{{ asset('images/Carte-iles-med-1170.jpg') }}">
            </a>
        </main>

    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('a.list-link').click(function(e){
                $(this).toggleClass('bold').next().toggleClass('hidden');
                return false;
            });
            $('area.map-link').click(function(e){
                $(".list-link").removeClass('bold').next().addClass('hidden');
                islandId = $(this).data('island-id');
                $('.list-link-' + islandId).addClass('bold').next().removeClass('hidden');
                return false;
            });
        });
    </script>
@endsection