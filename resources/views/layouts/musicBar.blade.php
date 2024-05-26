@extends('layouts.master')
@section('content')
    <div class="container-fluid p-0">
        @if(session('verify'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('verify') }}
            </div>
        @endif
        <div class="d-flex flex-column flex-md-row">
            <div class="d-none d-md-flex col-4 col-md-2 ps-0 pe-1 ">
                <div class="d-flex flex-column bg-gray rounded-3 w-100">
                    <div class="row my-1 d-flex flex-column mt-3 px-3">
                        <div class="col-12 col-md-12 col-lg-12 col-xl-8 ">
                            <a href="{{route('index_all', 'musics')}}">
                                <button type="button" class="btn btn-secondary rounded-pill mb-2 col-12 p-0 py-1">All Musics
                                </button>
                            </a>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-8">
                            <a href="{{route('index_all', 'bands')}}">
                                <button type="button" class="btn btn-secondary rounded-pill mb-2 col-12 p-0 py-1">All Bands
                                </button>
                            </a>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-8">
                            <a href="{{route('index_all', 'albums')}}">
                                <button type="button" class="btn btn-secondary rounded-pill mb-2 col-12 p-0 py-1">All Albuns
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="ps-2 py-3 d-flex flex-column">
                        @foreach($randomBarMusics as $music)
                        <a href="{{ route('index_music', $music->id ) }}" class="d-flex flex-md-colum flex-lg-row flex-column mt-2 text-decoration-none">
                            <div class="mx-2 p-0 my-auto col-6 col-md-8 col-lg-4 col-xl-3 d-inline" id="divImagem">
                                <img class="rounded my-auto col-12" src="{{asset("storage/".$music->photo)}}" class="m-0" alt="png">
                            </div>
                            <div class="text-start text-white d-md-column d-lg-flex flex-column ms-2 col-6" id="divMusicaNome">
                                <h5 class="my-0">{{$music->name}}</h5>
                                <span class="fs-6">{{$music->band_name}}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @yield('contentPage')
        </div>
    </div>
@endsection
