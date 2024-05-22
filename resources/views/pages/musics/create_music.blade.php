@extends('layouts.musicBar')
@section('contentPage')
    <div class="container-fluid d-flex col-12 col-md-10 me-0 ps-1 pe-0">
        <div class="container-fluid mx-auto ps-2 bg-gray rounded-3 ">
            <div class="mb-3 mt-4 mx-2 bg-gray border-0 mx-auto">
                <div class="row col-md-6 mx-auto">
                    <div class="">
                        <form action="{{route('store_music')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="position-relative mx-auto w-50">
                                <img src="{{asset('files/img/musicCoverDefault.png')}}" id="imageExample"
                                     class="img-fluid rounded" alt="...">
                                <button type="button"
                                        class="position-absolute btn btn-dark bg-gray rounded-circle bottom-0 end-0 m-2">
                                    <label class="bi bi-folder-plus fs-4 d-inline-block m-auto mt- text-white"
                                           for="inputFile">
                                        <input type="file" accept="image/*" name="music_image" hidden id="inputFile"
                                               onchange="document.getElementById('imageExample').src = window.URL.createObjectURL(this.files[0])">
                                    </label>
                                </button>
                            </div>
                            <div class="container mt-4">
                                <div class="d-flex flex.row">
                                    <div class="col-6 col-md-12 col-lg-9 col-xl-6">
                                        @error('album_id')
                                        <div class="alert alert-danger p-1 text-center mx-4" role="alert">
                                            Album Inválido!
                                        </div>
                                        @enderror
                                        <h5 class="text-white">Choose the Album of the Music</h5>
                                        <div class="container-fluid p-0 ">
                                            @foreach($albums as $album)
                                                <input type="radio" class="btn-check " name="album_id"
                                                       id="option{{$album->id}}"
                                                       autocomplete="off" value="{{$album->id}}">
                                                <label class="btn col-5 col-md-3" for="option{{$album->id}}"
                                                       id="labeloption{{$album->id}}"
                                                       onclick="checkAlbum(this)">
                                                    <div class="card w-100 bg-transparent border-0 mb-2 text-white">
                                                        <img src="{{asset('storage/'.$album->photo)}}"
                                                             class="rounded"
                                                             alt="...">
                                                        <div class="card-body p-0 mx-0 mt-1">
                                                            <h6 class="m-0">{{ $album->name }}</h6>
                                                        </div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-6 text-white">
                                        <div class="mb-3">
                                            <label for="inputName_band" class="form-label">Nome da Musica</label>
                                            <input name="music_name" type="text"
                                                   class="form-control @error('music_name') is-invalid @enderror"
                                                   id="inputName_band"
                                                   aria-describedby="emailHelp" value="{{ old('music_name') }}"
                                                   placeholder="Musica">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputMusic_length" class="form-label">Lenght of the Music
                                                at </label>
                                            <input name="music_length" type="text"
                                                   class="form-control @error('music_length') is-invalid @enderror"
                                                   id="inputMusic_length"
                                                   aria-describedby="emailHelp" value="{{ old('music_length') }}"
                                                   placeholder="10.20 (min.seg)">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 mt-3">Criar Musica</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
