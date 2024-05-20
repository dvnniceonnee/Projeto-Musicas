@extends('layouts.musicBar')
@section('contentPage')
    <div class="container-fluid d-flex col-8 col-md-10 me-0 ps-1 pe-0">
        <div class="container-fluid mx-auto ps-2 bg-gray rounded-3 ">
            <div class="mb-3 mt-4 mx-2 bg-gray border-0 mx-auto">
                <div class="row col-md-6 mx-auto">
                    <div class="">
                        <form action="{{route('store_album')}}" method="POST">
                            @csrf
                            <div class="position-relative mx-auto w-50">
                                <img src="{{asset('files/img/musicCoverDefault.png')}}" id="imageExample"
                                     class="img-fluid rounded" alt="...">
                                <button type="button"
                                        class="position-absolute btn btn-dark bg-gray rounded-circle bottom-0 end-0 m-2">
                                    <label class="bi bi-folder-plus fs-4 d-inline-block m-auto mt- text-white"
                                           for="inputFile">
                                        <input type="file" accept="image/*" name="album_image" hidden id="inputFile"
                                               onchange="document.getElementById('imageExample').src = window.URL.createObjectURL(this.files[0])">
                                    </label>
                                </button>
                            </div>
                            <div class="container mt-4 text-white">
                                <div class="d-flex flex-row align-content-center">
                                    <div class="col-6">
                                        <div>
                                            @error('band_id')
                                        <span class="badge text-bg-danger ms-5">Banda Inválida!</span>
                                            @enderror
                                        <h5>Choose the band </h5>
                                        </div>
                                        <div class="container-fluid p-0">
                                            @if($bandExists)
                                                <input type="radio" class="btn-check" checked name="band_id" id="option{{$allBands->id}}"
                                                       autocomplete="off" value="{{$allBands->id}}">
                                                <label class="btn col-3 btn-success" for="option{{$allBands->id}}" id="labeloption{{$allBands->id}}"
                                                       onclick="checkBand(this)">
                                                    <div class="card w-100 bg-transparent border-0 mb-2 text-white">
                                                        <img src="{{asset('storage/' . $allBands->photo)}}"
                                                             class=" rounded"
                                                             alt="...">
                                                        <div class="card-body p-0 mx-0 mt-1">
                                                            <h6 class="m-0">{{$allBands->name}}</h6>
                                                        </div>
                                                    </div>
                                                </label>
                                            @else
                                                @foreach($allBands as $band)
                                                    @if($band->id == old('band_id'))
                                                        <input type="radio" class="btn-check" name="band_id" checked value="{{$band->id}}" id="option{{$band->id}}"
                                                               autocomplete="off">
                                                        <label class="btn col-3 btn-success" for="option{{$band->id}}" id="labeloption{{$band->id}}"
                                                               onclick="checkBand(this)">
                                                            <div class="card w-100 bg-transparent border-0 mb-2 text-white">
                                                                <img src="{{asset('storage/'.$band->photo)}}"
                                                                     class=" rounded"
                                                                     alt="...">
                                                                <div class="card-body p-0 mx-0 mt-1">
                                                                    <h6 class="m-0">{{$band->name}}</h6>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    @else
                                                        <input type="radio" class="btn-check" name="band_id" value="{{$band->id}}" id="option{{$band->id}}"
                                                               autocomplete="off">
                                                        <label class="btn col-3" for="option{{$band->id}}" id="labeloption{{$band->id}}"
                                                               onclick="checkBand(this)">
                                                            <div class="card w-100 bg-transparent border-0 mb-2 text-white">
                                                                <img src="{{asset('storage/'.$band->photo)}}"
                                                                     class=" rounded"
                                                                     alt="...">
                                                                <div class="card-body p-0 mx-0 mt-1">
                                                                    <h6 class="m-0">{{$band->name}}</h6>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    @endif


                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 mx-auto">
                                        <div class="mb-3">
                                            <label for="inputAlbum_name" class="form-label">Nome do Album</label>
                                            <input name="album_name" type="text" class="form-control @error('album_name') is-invalid @enderror"
                                                   id="inputAlbum_name" value="{{ old('album_name') }}"
                                                   aria-describedby="emailHelp" placeholder="Album">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputAlbum_released_at" class="form-label ">Album released
                                                at</label>
                                            <input name="released_at" type="date" value="{{ old('album_released_at') }}" class="form-control @error('released_at') is-invalid @enderror"
                                                   id="inputAlbum_released_at">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 mt-3">Criar Album</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
