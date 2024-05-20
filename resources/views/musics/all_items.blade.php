@extends('layouts.musicBar')
@section('contentPage')
    <div class="d-flex col-12 col-md-10 pe-0 ps-1">
        <div class="d-flex flex-column bg-gray rounded-3 p-3">
            <div class="d-flex">
                <button class="btn mx-0 p-1"><i class="bi bi-arrow-left-circle-fill fs-2 text-secundary"></i>
                </button>
                <button class="btn mx-0 p-1"><i class="bi bi-arrow-right-circle-fill fs-2 text-secundary"></i>
                </button>
            </div>
            <div class="d-flex container-fluid col-12 my-3 h-25 position-relative">
                <img src='{{$imgLink}}' class="w-100 object-fit-cover rounded " alt="">
                <div class="container text-white ms-5 position-absolute top-50 start-0 translate-middle-y">
                    <h1 class="fs-1"> Check out your favourite <span class="text-capitalize">{{$title}}!</span></h1>
                    <h2>Find your favourite {{$title}}!</h2>
                </div>
            </div>
            <div class="d-flex flex-column mt-5">
                <div class="container-fluid ">
                    <h4 class="text-white text-capitalize">{{$type}}</h4>
                    <div class="row p-0 mt-3">
                        @foreach($items as $item)
                            @if($title == "band")
                                <a class="card col-3 col-md-2 col-lg-2 col-xl-1 bg-gray border-0 mb-2 text-white"
                                   href="{{route('index_band', $item->id)}}">
                                    <img src="{{asset('storage/'.$item->photo)}}" class="w-100 rounded" alt="...">
                                    <div class="card-body p-0 mx-0 mt-1 fs-6 text-center">
                                        <h5 class="m-0 fs-6">{{$item->name}}</h5>
                                    </div>
                                </a>
                            @elseif($title == "music")
                                <a class="card col-3 col-md-2 col-lg-2 col-xl-1 bg-gray border-0 mb-2 text-white"
                                   href="{{route('index_music', $item->id)}}">
                                    <img src="{{asset('storage/'.$item->photo)}}" class="w-100 rounded" alt="...">
                                    <div class="card-body p-0 mx-0 mt-1 fs-6 text-center">
                                        <h5 class="m-0 fs-6">{{$item->name}}</h5>
                                    </div>
                                </a>
                            @elseif($title == "album")
                                <a class="card col-3 col-md-2 col-lg-2 col-xl-1 bg-gray border-0 mb-2 text-white"
                                   href="{{route('index_album', $item->id)}}">
                                    <img src="{{asset('storage/'.$item->photo)}}" class="w-100 rounded" alt="...">
                                    <div class="card-body p-0 mx-0 mt-1 fs-6 text-center">
                                        <h5 class="m-0 fs-6">{{$item->name}}</h5>
                                    </div>
                                </a>
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
