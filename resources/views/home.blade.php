@extends('layouts.musicBar')
@section('contentPage')
    <div class="d-flex col-12 col-md-10 pe-0 ps-1">
        <div class="d-flex flex-column bg-gray rounded-3 p-3">
            <div class="d-flex">
                <button class="btn mx-0 p-1"><i class="bi bi-arrow-left-circle-fill fs-2 text-secundary"></i></button>
                <button class="btn mx-0 p-1"><i class="bi bi-arrow-right-circle-fill fs-2 text-secundary"></i></button>
            </div>
            <div class="d-flex container-fluid col-12 my-3 h-25 position-relative ">
                <img src="{{asset("files/img/banners/bannerHome.jpg")}}" class="w-100 object-fit-cover rounded " alt="">
                <div class="container text-white ms-5 position-absolute top-50 start-0 translate-middle-y">
                    <h1 class="fs-1"> Listen now to your Favourite Music!</h1>
                    <h2>Find your favourite bands!</h2>
                </div>
            </div>
            <div class="d-flex flex-column mt-5">
                <div class="container-fluid">
                    <h4 class="text-white">Mix's</h4>
                    <div class="row p-0 mt-3">
                        <div class="card col-6 col-md-3 col-lg-2 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset("files/img/musicCover1.png")}}" class="w-100 rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h5 class="m-0">Mix Rock</h5>
                                <span>Band 1, Band 2, Band 3</span>
                            </div>
                        </div>
                        <div class="card col-6 col-md-3 col-lg-2 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset("files/img/musicCover2.png")}}" class="w-100 rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h5 class="m-0">Mix Rock</h5>
                                <span>Band 1, Band 2, Band 3</span>
                            </div>
                        </div>
                        <div class="card col-6 col-md-3 col-lg-2 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset("files/img/musicCover3.jpg")}}" class="w-100 rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h5 class="m-0">Mix Rock</h5>
                                <span>Band 1, Band 2, Band 3</span>
                            </div>
                        </div>
                        <div class="card col-6 col-md-3 col-lg-2 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset("files/img/musicCover4.png")}}" class="w-100 rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h5 class="m-0">Mix Rock</h5>
                                <span>Band 1, Band 2, Band 3</span>
                            </div>
                        </div>
                        <div class="card col-6 col-md-3 col-lg-2 bg-gray border-0 mb-2 text-white">
                            <img src="{{asset("files/img/musicCover5.png")}}" class="w-100 rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h5 class="m-0">Mix Rock</h5>
                                <span>Band 1, Band 2, Band 3</span>
                            </div>
                        </div>
                        <div class="card col-6 col-md-3 col-lg-2 bg-gray border-0 text-white">
                            <img src="{{asset("files/img/musicCover1.png")}}" class="w-100 rounded" alt="...">
                            <div class="card-body p-0 mx-0 mt-1">
                                <h5 class="m-0">Mix Rock</h5>
                                <span>Band 1, Band 2, Band 3</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--bands-->
            <div class="d-flex flex-column mt-5">
                <div class="container-fluid">
                    <h4 class="text-white">Bandas</h4>
                    <div class="row p-0 mt-3">
                        @foreach($sixBands as $band)
                            <div class="card col-6 col-md-3 col-lg-2 bg-gray border-0 mb-2 text-white">
                                <a href="{{route('index_band', $band->id)}}" class="text-decoration-none text-white text-capitalize">
                                    <img src="{{asset('storage/'.$band->photo)}}" class="w-100 rounded" alt="...">
                                    <div class="card-body p-0 mx-0 mt-1">
                                        <h5 class="m-0">{{$band->name}}</h5>
                                        <span>@foreach($band->genres as $genre)
                                                {{$genre}},
                                            @endforeach</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!--albums-->
            <div class="d-flex flex-column mt-5">
                <div class="container-fluid mt-3">
                    <h4 class="text-white">Albums</h4>
                    <div class="row p-0 mt-3">
                        @foreach($sixAlbums as $album)
                            <div class="card col-6 col-md-3 col-lg-2 bg-gray border-0 mb-2 text-white">
                                <a href="{{route('index_album', $album->id)}}" class="text-decoration-none text-white text-capitalize">
                                    <img src="{{asset('storage/'.$album->photo)}}" class="w-100 rounded" alt="...">
                                    <div class="card-body p-0 mx-0 mt-1">
                                        <h5 class="m-0">{{$album->name}}</h5>
                                        <span>{{$album->band_name}}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
