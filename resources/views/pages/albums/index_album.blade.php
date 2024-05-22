@extends('layouts.musicBar')
@section('contentPage')
    <div class="container-fluid d-flex col-12 col-md-10 me-0 ps-1 pe-0">
        <div class="container-fluid ps-2 bg-gray rounded-3 ">
            <div class="d-flex">
                <button class="btn mx-0 p-1"><i class="bi bi-arrow-left-circle-fill fs-2 text-secundary"></i>
                </button>
                <button class="btn mx-0 p-1"><i class="bi bi-arrow-right-circle-fill fs-2 text-secundary"></i>
                </button>
            </div>
            <div class="card mb-3 mt-4 mx-2 bg-gray border-0" style="max-width: 750px;">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{asset('storage/'.$album->photo)}}" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-md-6 d-flex flex-column ">
                        <div class="container d-flex justify-content-end mt-3">
                            <a href="{{route('edit_album_view', $album->id)}}" class="btn btn-warning w-25 rounded-pill">Edit</a>
                        </div>
                        <div class="card-body text-white d-flex flex-column justify-content-end">
                            <h3 class="card-title fw-bold text-capitalize">{{$album->name}}</h3>
                            <h5 class="card-title">Type : Album</h5>
                            <h5 class="card-title">Band : {{$album->band_name}}</h5>
                            <h5 class="card-title">Tracks : {{$album->number_tracks}} </h5>
                            <h5 class="card-title">Release at : {{$album->released_at}}</h5>
                            <h6>Genres :
                                @foreach($album->genres_band as $genre)
                                       {{$genre['genre_name']}},
                            @endforeach</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column mt-5">
                <div class="container-fluid ">
                    <h4 class="text-white text-capitalize">Content of Album</h4>
                    <div class="row p-0 mt-3">
                        @foreach($allMusicsOfAlbum as $music)
                        <a class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white" href="{{route('index_music', $music->id)}}">
                            <img src="{{asset('storage/'.$music->photo)}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0 fs-6">{{$music->name}}</h6>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="container-fluid ">
                    <h4 class="text-white text-capitalize">Others albums of this band</h4>
                    <div class="row p-0 mt-3 mb-5">
                        @foreach($albumsOfBand as $album)
                        <a class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white" href="{{route('index_album', $album->id)}}">
                            <img src="{{asset('storage/'.$album->photo)}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1 w-100">
                                <h6 class="m-0 fs-6">{{$album->name}}</h6>
                                <span>{{(new \Carbon\Carbon($album->released_at))->year != -1 ? (new \Carbon\Carbon($album->released_at))->year : ""}}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
