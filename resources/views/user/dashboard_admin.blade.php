@extends('layouts.master')
@section('content')
    <div class="container-fluid p-0">
        @if(session('message'))
            <div class="alert alert-success text-center mx-auto w-50" role="alert">
                {{session('message')}}
            </div>
        @endif
        <div class="modal fade" id="modalDashboard" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Atenção <i class="bi bi-exclamation-triangle-fill"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-danger m-3" role="alert">
                        <h5 id="modalDashboardAlert"></h5>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-danger" href="" id="modalDeleteButton">Apagar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row">
            {{--Bands--}}
            <div class="container-fluid col-12 col-md-4 p-1 pt-0">
                <div class="d-flex flex-column p-3 text-white bg-gray rounded h-100">
                    <div class="d-flex d-flex justify-content-between mb-3">
                        <h4 class="rounded-pill">Lista de Bandas</h4>
                        <a href="{{route('create_band')}}">
                            <button class="btn btn-dark">Nova Banda<i class="bi bi-plus-lg"></i></button>
                        </a>
                    </div>
                    <div class="text-white mx-1">
                        <table id="TableBands" class="text-white text-center align-middle">
                            <thead>
                            <tr>
                                <th class="text-center">Cover</th>
                                <th class="text-center">Band Name</th>
                                <th class="text-center">Founded at</th>
                                <th class="text-center">Founded in</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                            @foreach($allBands as $band)
                                <tr>
                                    <td class="p-1"><a href="{{route('index_band', $band->id)}}"><img
                                                src="{{asset('storage/'.$band->photo)}}"
                                                class="w-50 rounded-3 d-block mx-auto" alt=""></a></td>
                                    <td><a href="{{route('index_band', $band->id)}}">{{$band->name}}</a></td>
                                    <td>{{$band->founded_in}}</td>
                                    <td class="text-center">{{$band->founded_at}}</td>
                                    <td>
                                        <a class="btn btn-warning rounded-circle px-1 py-0"
                                           href="{{route('edit_band_view', $band->id)}}"><i
                                                class="bi bi-pencil-square"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger rounded-circle px-1 py-0"
                                                data-bs-toggle="modal" data-bs-target="#modalDashboard"
                                                data-bs-type="band" data-bs-name="{{$band->name}}"
                                                data-bs-id="{{$band->id}}"
                                        ><i
                                                class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{--Albums--}}
            <div class="container-fluid col-12 col-md-4 p-1 pt-0 ">
                <div class="d-flex flex-column p-3 text-white bg-gray rounded h-100">
                    <div class="d-flex d-flex justify-content-between mb-3">
                        <h4 class="rounded-pill">Lista de Albums</h4>
                        <a href="{{route('create_album', -1)}}">
                            <button class="btn btn-dark ">Novo Album <i class="bi bi-plus-lg"></i></button>
                        </a>
                    </div>
                    <div class="text-white mx-1">
                        <table id="TableAlbums" class="text-white text-center align-middle">
                            <thead>
                            <tr>
                                <th class="text-center">Cover</th>
                                <th class="text-center">Album Name</th>
                                <th class="text-center">Band</th>
                                <th class="text-center">Released At</th>
                                <th class="text-center">Number of Tracks</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                            @foreach($allAlbums as $album)
                                <tr>
                                    <td class="p-1"><a href="{{route('index_album', $album->id)}}"><img
                                                src="{{asset('storage/'.$album->photo)}}"
                                                class="w-50 rounded-3 d-block mx-auto" alt=""></a></td>
                                    <td><a class="text-decoration-none text-white"
                                           href="{{route('index_album', $album->id)}}">{{$album->name}}</a></td>
                                    <td><a class="text-decoration-none text-white"
                                           href="{{route('index_band', $album->band_id)}}">{{$album->band_name}}</a>
                                    </td>
                                    <td>{{$album->released_at}}</td>
                                    <td class="text-center">{{$album->number_tracks}}</td>
                                    <td>
                                        <a href="{{route('edit_album_view', $album->id)}}"
                                           class="btn btn-warning rounded-circle px-1 py-0"><i
                                                class="bi bi-pencil-square"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger rounded-circle px-1 py-0"
                                                data-bs-toggle="modal" data-bs-target="#modalDashboard"
                                                data-bs-type="album" data-bs-name="{{$album->name}}"
                                                data-bs-id="{{$album->id}}"
                                        ><i
                                                class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{--Musics --}}
            <div class="container-fluid col-12 col-md-4 p-1 pt-0 ">
                <div class="d-flex flex-column p-3 text-white bg-gray rounded  h-100">
                    <div class="d-flex d-flex justify-content-between mb-3">
                        <h4 class="rounded-pill">Lista de Musicas</h4>
                        <a href="{{route('create_music', [-1, -1])}}">
                            <button class="btn btn-dark ">Nova Musica <i class="bi bi-plus-lg"></i></button>
                        </a>
                    </div>
                    <div class="text-white mx-1">
                        <table id="TableMusics" class="text-white text-center align-middle">
                            <thead>
                            <tr>
                                <th class="text-center">Cover</th>
                                <th class="text-center">Music Name</th>
                                <th class="text-center">Length</th>
                                <th class="text-center">Band</th>
                                <th class="text-center">Album</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                            @foreach($allMusics as $music)
                                <tr>
                                    <td class="p-1"><a href="{{route('index_music', $music->id)}}"><img
                                                src="{{asset('storage/'.$music->photo)}}"
                                                class="w-50 mx-auto d-block rounded-3" alt=""></a></td>
                                    <td>{{$music->name}}</td>
                                    <td>{{$music->length}} min</td>
                                    <td class="text-center"><a
                                            href="{{route('index_band', $music->band_id)}}">{{$music->band_name}}</a>
                                    </td>
                                    <td class="text-center"><a
                                            href="{{route('index_album', $music->album_id)}}">{{$music->album_name}}</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning rounded-circle px-1 py-0"
                                           href="{{route('edit_music_view', $music->id)}}"><i
                                                class="bi bi-pencil-square"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger rounded-circle px-1 py-0"
                                                data-bs-toggle="modal" data-bs-target="#modalDashboard"
                                                data-bs-type="music" data-bs-name="{{$music->name}}"
                                                data-bs-id="{{$music->id}}"
                                        ><i
                                                class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
