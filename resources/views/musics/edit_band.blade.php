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
            <!-- Modal -->
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

            <div class="card mb-3 mt-4 mx-2 bg-gray border-0" style="max-width: 750px;">
                <form action="{{route('edit_band')}}" method="POST" enctype="multipart/form-data" class="row">
                    @csrf
                    <div class="col-md-6 position-relative mx-auto w-50">
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
                            <button class="btn btn-danger col-12 rounded-pill" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Apagar Banda
                            </button>
                        </div>
                        <div class="card-body text-white d-flex flex-column justify-content-end">
                            <input type="text" name="id" value="{{$band->id}}" hidden>
                            <label for="inputBandName">Nome da Banda</label>
                            <input type="text" class="form-control text-dark mb-3 d-inline fs-5" id="inputBandName"
                                   placeholder="{{$band->name}}" name="music_name">
                            <input type="date" class="form-control text-dark mb-3 d-inline fs-5" id="inputBandName"
                                   value="{{$band->founded_at}}" name="music_released_at">
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
