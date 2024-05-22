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
                    <div class="col-md-6 position-relative">
                        <img src="{{asset('storage/'.$music->photo)}}" class="img-fluid rounded" alt="...">
                        <a class="position-absolute top-0 end-0 me-2 text-warning" href="{{route('add_favourites_music', $music->id)}}"><i class="bi @if($music->favourite_user == true)bi-star-fill @else bi-star @endif fs-2"></i></a>
                    </div>
                    <div class="col-md-5 d-flex flex-column">
                        <div class="container d-flex justify-content-end mt-3">
                            <a href="{{route('edit_music_view', $music->id)}}" class="btn btn-warning w-25 rounded-pill">Edit</a>
                        </div>
                        <div class="card-body text-white d-flex flex-column justify-content-end py-0">
                            <h3 class="card-title fw-bold">{{$music->name}}</h3>
                            <h5 class="card-title">Band : {{$music->band_name}}</h5>
                            <h5 class="card-title">Length : {{$music->length}} min </h5>
                            <h5 class="card-title">Album : {{$music->album_name}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column mt-5">
                <div class="container-fluid ">
                    <h4 class="text-white">Some Musics of <span class="fw-bold">{{$music->band_name}}</span></h4>
                    <div class="row p-0 mt-3">
                        @foreach($randomMusics as $music)
                            <a class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white text-decoration-none"
                               href="{{route('index_music', $music->id)}}">
                                <img src="{{asset('storage/'.$music->photo)}}" class=" rounded" alt="...">
                                <div class="card-body p-0 mx-0 mt-1">
                                    <h6 class="m-0 fs-6">{{$music->name}}</h6>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="container-fluid ">
                    <h4 class="text-white text-capitalize">Musics you may like</h4>
                    <div class="row p-0 mt-3">
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1 w-100">
                                <h6 class="m-0 fs-6">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                        <div class="card col-3 col-md-2 col-lg-1 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset('files/img/musicCover1.png')}}" class=" rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h6 class="m-0">Parachutes</h6>
                                <span>2001</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
