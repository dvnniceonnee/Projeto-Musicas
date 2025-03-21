@extends('layouts.musicBar')
@section('contentPage')
    <div class="container-fluid d-flex col-12 col-md-10 me-0 ps-0 pe-0">
        <div class="container-fluid ps-2 bg-gray rounded-3 h-100">
            <div class="d-flex mb-3">
                <button class="btn mx-0 p-1"><i class="bi bi-arrow-left-circle-fill fs-2 text-secundary"></i>
                </button>
                <button class="btn mx-0 p-1"><i class="bi bi-arrow-right-circle-fill fs-2 text-secundary"></i>
                </button>
            </div>
            @if(\App\Models\User::checkIfItsAdmin())
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Alerta!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                Tem a certeza que deseja apagar a musica {{$music->name}} ?
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-primary"
                               href="{{route('delete_music', $music->id)}}">Apagar</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(session('message'))
            <div class="alert alert-success text-center mx-auto my-2" role="alert">
                    {{ session('message')}}
                </div>
            @endif
            <div class="mb-3 mt-4 mx-2 bg-gray border-0 col-12 d-flex flex-row">
                <form action="{{route('edit_music')}}" method="POST" enctype="multipart/form-data" class="d-flex flex-row">
                    @csrf
                    <div class="col-12 col-md-6 col-lg-5 col-xl-3 position-relative me-4">
                        <img src="{{asset('storage/'.$music->photo)}}" id="imageMusic"
                             class="rounded img-fluid" alt="...">
                        <button type="button"
                                class="position-absolute btn btn-dark bg-gray rounded-circle bottom-0 end-0 m-2">
                            <label class="bi bi-folder-plus fs-4 d-inline-block m-auto mt- text-white"
                                   for="inputFile">
                                <input type="file" accept="image/*" name="music_image" hidden id="inputFile"
                                       onchange="document.getElementById('imageMusic').src = window.URL.createObjectURL(this.files[0])">
                            </label>
                        </button>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 d-flex flex-column">
                        <div class="container d-flex flex-column justify-content-end mt-3 col-12 col-md-8 me-0">
                            <button type="submit" class="btn btn-warning col-12 my-2 rounded-pill">Salvar</button>
                            @if(Auth::user()->type == \App\Models\User::Type_Admin)
                            <button class="btn btn-danger col-12 rounded-pill" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Apagar Musica
                            </button>
                            @endif
                        </div>
                        <div class="card-body text-white d-flex flex-column justify-content-end">
                            <input type="text" name="id" value="{{$music->id}}" hidden="">
                            <label for="InputMusicName">Nome da Musica</label>
                            <input type="text" class="form-control text-dark mb-3 d-inline fs-5" id="InputMusicName"
                                   placeholder="{{$music->name}}" value="{{$music->name}}" name="music_name">
                            <label for="inputMusicLength">Length da Musica</label>
                            <input type="text" class="form-control text-dark mb-3 d-inline" id="inputMusicLength"
                                   placeholder="Length : {{$music->length}} min" value="{{$music->length}}" name="music_length">
                            <h5 class="card-title">Band : {{$music->band_name}}</h5>
                            <h5 class="card-title">Album : {{$music->album_name}}</h5>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
