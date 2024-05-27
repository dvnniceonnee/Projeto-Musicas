@extends('layouts.musicBar')
@section('contentPage')
    <div class="container-fluid d-flex col-12 col-md-10 me-0 ps-1 pe-0 ">
        <div class="container-fluid ps-2 bg-gray rounded-3 ">

            <div class="d-flex">
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
                                Tem a certeza que deseja apagar a musica {{$album->name}} ?
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-primary"
                               href="{{route('delete_album', $album->id)}}">Apagar</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="card mb-3 mt-4 mx-2 bg-gray border-0" style="max-width: 750px;">
                @if(session('message'))
                    <div class="alert alert-success text-center d-inline mx-auto" role="alert">
                        {{ session('message')}}
                    </div>
                @endif
                <form action="{{route('edit_album')}}" method="POST" enctype="multipart/form-data" class="row">
                    @csrf
                    <div class="col-md-6 position-relative mx-auto w-50">
                        @error('album_image')
                        <div class="alert alert-danger" role="alert">
                            Image file Invalid!
                        </div>
                        @enderror
                        <img src="{{asset('storage/'.$album->photo)}}" id="imageAlbum"
                             class="img-fluid rounded" alt="...">
                        <button type="button"
                                class="position-absolute btn btn-dark bg-gray rounded-circle bottom-0 end-0 m-2">
                            <label class="bi bi-folder-plus fs-4 d-inline-block m-auto mt- text-white"
                                   for="inputFile">
                                <input type="file" accept="image/*" name="album_photo" hidden id="inputFile"
                                       onchange="document.getElementById('imageAlbum').src = window.URL.createObjectURL(this.files[0])">
                            </label>
                        </button>
                    </div>
                    <div class="col-md-5 d-flex flex-column">
                        <div class="container d-flex flex-column justify-content-end mt-3 col-6 me-0">
                            <button type="submit" class="btn btn-warning col-12 my-2 rounded-pill">Salvar</button>
                            @if(\App\Models\User::checkIfItsAdmin())
                            <button class="btn btn-danger col-12 rounded-pill" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Apagar Banda
                            </button>
                            @endif
                        </div>
                        <div class="card-body text-white d-flex flex-column justify-content-end">
                            <input type="text" name="id" value="{{$album->id}}" hidden>
                            <label for="inputAlbum_name">Nome do Album</label>
                            <input type="text"
                                   class="form-control text-dark mb-3 d-inline fs-5 @error('album_name') is-invalid @enderror"
                                   id="inputAlbum_name"
                                   placeholder="{{$album->name}}" value="{{$album->name}}" name="album_name">
                            <label for="inputAlbum_name">Data de lançamento</label>
                            <input type="date"
                                   class="form-control text-dark mb-3 d-inline fs-5 @error('album_released_at') is-invalid @enderror"
                                   id="inputBand_founded_at"
                                   value="{{$album->released_at}}" name="album_released_at">
                        </div>
                    </div>
                </form>
                <div class="container-fluid mt-5">
                    <div class="d-flex flex-row container">
                        <h4 class="text-white text-capitalize my-auto">Musics</h4>
                        <a class="mx-2 text-success mb-2 p-0" href="{{route('create_music',[ -1, $album->id])}}">Add<i
                                class="bi bi-plus-lg"></i></a>
                    </div>
                    <div class="row p-0 mt-3 mb-5">
                        @foreach($allMusicsOfAlbum as $music)
                            <a class="card col-3 col-md-2 col-lg-2 bg-gray border-0 mb-2 text-white"
                               href="{{route('index_music', $music->id)}}">
                                <img src="{{asset('storage/'.$music->photo)}}" class=" rounded" alt="...">
                                <div class="card-body p-0 mx-0 mt-1 w-100">
                                    <h6 class="m-0 fs-6">{{$music->name}}</h6>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    {{$allMusicsOfAlbum->links()}}
                </div>
            </div>
@endsection
