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
                                Tem a certeza que deseja apagar a musica {{$band->name}} ?
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-primary"
                               href="{{route('delete_band', $band->id)}}">Apagar</a>
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
                <form action="{{route('edit_band')}}" method="POST" enctype="multipart/form-data" class="row">
                    @csrf
                    <div class="col-md-6 position-relative mx-auto w-50">
                        @error('band_image')
                        <div class="alert alert-danger" role="alert">
                            Image file Invalid!
                        </div>
                        @enderror
                        <h2 class="text-white">Banda</h2>
                        <img src="{{asset('storage/'.$band->photo)}}" id="imageBand"
                             class="img-fluid rounded" alt="...">
                        <button type="button"
                                class="position-absolute btn btn-dark bg-gray rounded-circle bottom-0 end-0 m-2">
                            <label class="bi bi-folder-plus fs-4 d-inline-block m-auto mt- text-white"
                                   for="inputFile">
                                <input type="file" accept="image/*" name="band_image" hidden id="inputFile"
                                       onchange="document.getElementById('imageBand').src = window.URL.createObjectURL(this.files[0])">
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
                            <input type="text" name="id" value="{{$band->id}}" hidden>
                            <label for="inputBandName">Nome da Banda</label>
                            <input type="text"
                                   class="form-control text-dark mb-3 d-inline fs-5 @error('band_name') is-invalid @enderror"
                                   id="inputBandName"
                                   placeholder="{{$band->name}}" value="{{$band->name}}" name="band_name">
                            <input type="date"
                                   class="form-control text-dark mb-3 d-inline fs-5 @error('band_founded_at') is-invalid @enderror"
                                   id="inputBand_founded_at"
                                   value="{{$band->founded_at}}" name="band_founded_at">
                            <div class="mb-2 d-flex flex-column">
                                <label for="inputBand_genres" class="form-label">Country of the Band</label>
                                <select class="selectpicker w-100 @error('band_country') is-invalid @enderror"
                                        data-actions-box="true" name="band_country"
                                        id="inputPais" data-live-search="true" title="Choose the country"
                                        data-live-search-placeholder="Search" data-size="5"
                                        data-selected-text-format="values">
                                    @foreach($countries as $country)
                                        @if($country->id == $band->country_id)
                                            <option selected value="{{$country->id}}">{{$country->name}}</option>
                                        @else
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('country_band')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
                <div class="d-flex flex-column mt-5">
                    <div class="container-fluid ">
                        <div class="d-flex flex-row ">
                        <h4 class="text-white text-capitalize my-auto">Albums</h4>
                        <a class="mx-2 text-success mb-2 p-0" href="{{route('create_album', $band->id)}}">Add<i class="bi bi-plus-lg"></i></a>
                        </div>
                        <div class="row p-0 mt-3">
                            @foreach($allAlbumsOfBand as $album)
                                <a class="card col-3 col-md-2 col-lg-2 bg-gray border-0 mb-2 text-white"
                                   href="{{route('index_album', $album->id)}}">
                                    <img src="{{asset('storage/'.$album->photo)}}" class=" rounded" alt="...">
                                    <div class="card-body p-0 mx-0 mt-1">
                                        <h6 class="m-0 fs-6">{{$album->name}}</h6>
                                        <span>{{ (new \Carbon\Carbon($album->released_at))->year != -1 ? (new \Carbon\Carbon($album->released_at))->year : ""}}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="container-fluid ">
                        <div class="d-flex flex-row ">
                            <h4 class="text-white text-capitalize my-auto">Musics</h4>
                            <a class="mx-2 text-success mb-2 p-0" href="{{route('create_music',[ $band->id, -1])}}">Add<i class="bi bi-plus-lg"></i></a>
                        </div>
                        <div class="row p-0 mt-3 mb-5">
                            @foreach($allMusicsOfBand as $music)
                                <a class="card col-3 col-md-2 col-lg-2 bg-gray border-0 mb-2 text-white"
                                   href="{{route('index_music', $music->id)}}">
                                    <img src="{{asset('storage/'.$music->photo)}}" class=" rounded" alt="...">
                                    <div class="card-body p-0 mx-0 mt-1 w-100">
                                        <h6 class="m-0 fs-6">{{$music->name}}</h6>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        {{$allMusicsOfBand->links()}}
                    </div>
                </div>
            </div>
        </div>
@endsection
