@extends('layouts.musicBar')
@section('contentPage')
    <div class="container-fluid d-flex col-8 col-md-10 me-0 ps-1 pe-0">
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
                        <img src="{{asset('storage/'.$band->photo)}}" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="card-body text-white ">
                            <h3 class="card-title fw-bold">{{$band->name}}</h3>
                            <h6 class="card-title">Founded : {{$band->founded_at != null ? $band->founded_at : "Não definido" }} </h6>
                            <h6 class="card-title">Founden in : {{$band->country_band != null ? $band->country_band : "Não Definido"}}</h6>
                            <h6>Genres : @foreach($band->band_genres as $genre) {{$genre['genre_name']}}, @endforeach</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column mt-5">
                <div class="container-fluid ">
                    <h4 class="text-white text-capitalize">Albums</h4>
                    <div class="row p-0 mt-3">
                        @foreach($allAlbumsOfBand as $album)
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('storage/'.$album->photo)}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0 fs-6">{{$album->name}}</h6>
                                <span>{{ (new \Carbon\Carbon($album->released_at))->year != -1 ? (new \Carbon\Carbon($album->released_at))->year : ""}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="container-fluid ">
                    <h4 class="text-white text-capitalize">Musics</h4>
                    <div class="row p-0 mt-3 mb-5">
                        @foreach($allMusicsOfBand as $music)
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('storage/'.$music->photo)}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1 w-100">
                                <h6 class="m-0 fs-6">{{$music->name}}</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{$allMusicsOfBand->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
