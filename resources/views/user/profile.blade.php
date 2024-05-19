@extends('layouts.musicBar')
@section('contentPage')
    <div class="d-flex col-12 col-md-7 mt-2 mt-md-0 px-1">
        <div class="container-fluid bg-gray rounded">
            <div class="container-fluid d-flex flex-column">
                <form action="" class="text-white ">
                    @csrf
                    <div class="row col-12">
                        <div class="position-relative col-md-2 col-4 mt-5">
                            <h4 class="text-white">Profile Photo</h4>
                            <img src="{{asset('files/img/profilePhoto.webp')}}" id="profileImage"
                                 class="img-fluid rounded-circle" alt="...">
                            <button type="button"
                                    class="position-absolute btn btn-dark bg-gray rounded-circle bottom-0 end-0 m-2">
                                <label class="bi bi-folder fs-4 d-inline-block m-auto mt- text-white"
                                       for="inputFile">
                                    <input type="file" accept="image/*" name="band_image" hidden id="inputFile"
                                           onchange="document.getElementById('profileImage').src = window.URL.createObjectURL(this.files[0])">
                                </label>
                            </button>
                        </div>
                        <div class="col-8 mx-auto mt-5">
                            <button type="button" class="btn btn-warning">Update</button>
                        </div>
                    </div>
                    <div class="col-9 col-md-4 mt-2">
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputName" aria-describedby="emailHelp"
                                   placeholder="Miguel Madureira">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" disabled placeholder="Email@Email.com">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex col-12 col-md-3 mt-2 mt-md-0 ps-1 pe-1">
        <div class="container-fluid bg-gray rounded d-flex flex-column text-white p-3">
            <h4 class="">Your Music Favourites</h4>
            <ul class="text-center d-flex container-fluid row gap-0" id="listFavourites">
                <li class="col-3 list-group-item text-decoration-none position-relative border-0 ">
                    <div class="container-fluid rounded border bg-transparent pt-3 px-3 ">
                        <img src="{{asset('files/img/musicCover5.png')}}" class="img-fluid rounded" alt="...">
                        <a href="" class="position-absolute top-0 end-0 m-0 text-danger mx-2"><i
                                class="bi bi-x-circle-fill fs-4"></i></a>
                        <div class="card-body text-white m-0">
                            <h5 class="card-title fw-bold">Higher Power</h5>
                            <h6 class="">Coldplay</h6>
                        </div>
                    </div>

                </li>
                <li class="col-3 list-group-item text-decoration-none position-relative border-0">
                    <div class="container-fluid rounded border bg-transparent pt-3 px-3 ">
                        <img src="{{asset('files/img/musicCover5.png')}}" class="img-fluid rounded" alt="...">
                        <a href="" class="position-absolute top-0 end-0 m-0 text-danger mx-2"><i
                                class="bi bi-x-circle-fill fs-4"></i></a>
                        <div class="card-body text-white m-0">
                            <h5 class="card-title fw-bold">Higher Power</h5>
                            <h6 class="">Coldplay</h6>
                        </div>
                    </div>

                </li>
                <li class="col-3 list-group-item text-decoration-none position-relative border-0">
                    <div class="container-fluid rounded border bg-transparent pt-3 px-3 ">
                        <img src="{{asset('files/img/musicCover5.png')}}" class="img-fluid rounded" alt="...">
                        <a href="" class="position-absolute top-0 end-0 m-0 text-danger mx-2"><i
                                class="bi bi-x-circle-fill fs-4"></i></a>
                        <div class="card-body text-white m-0">
                            <h5 class="card-title fw-bold">Higher Power</h5>
                            <h6 class="">Coldplay</h6>
                        </div>
                    </div>

                </li>
                <li class="col-3 list-group-item text-decoration-none position-relative border-0">
                    <div class="container-fluid rounded border bg-transparent pt-3 px-3 ">
                        <img src="{{asset('files/img/musicCover5.png')}}" class="img-fluid rounded" alt="...">
                        <a href="" class="position-absolute top-0 end-0 m-0 text-danger mx-2"><i
                                class="bi bi-x-circle-fill fs-4"></i></a>
                        <div class="card-body text-white m-0">
                            <h5 class="card-title fw-bold">Higher Power</h5>
                            <h6 class="">Coldplay</h6>
                        </div>
                    </div>

                </li>
                <li class="col-3 list-group-item text-decoration-none position-relative border-0">
                    <div class="container-fluid rounded border bg-transparent pt-3 px-3 ">
                        <img src="{{asset('files/img/musicCover5.png')}}" class="img-fluid rounded" alt="...">
                        <a href="" class="position-absolute top-0 end-0 m-0 text-danger mx-2"><i
                                class="bi bi-x-circle-fill fs-4"></i></a>
                        <div class="card-body text-white m-0">
                            <h5 class="card-title fw-bold">Higher Power</h5>
                            <h6 class="">Coldplay</h6>
                        </div>
                    </div>

                </li>
                <li class="col-3 list-group-item text-decoration-none position-relative border-0">
                    <div class="container-fluid rounded border bg-transparent pt-3 px-3 ">
                        <img src="{{asset('files/img/musicCover5.png')}}" class="img-fluid rounded" alt="...">
                        <a href="" class="position-absolute top-0 end-0 m-0 text-danger mx-2"><i
                                class="bi bi-x-circle-fill fs-4"></i></a>
                        <div class="card-body text-white m-0">
                            <h5 class="card-title fw-bold">Higher Power</h5>
                            <h6 class="">Coldplay</h6>
                        </div>
                    </div>

                </li>
                <li class="col-3 list-group-item text-decoration-none position-relative border-0">
                    <div class="container-fluid rounded border bg-transparent pt-3 px-3 ">
                        <img src="{{asset('files/img/musicCover5.png')}}" class="img-fluid rounded" alt="...">
                        <a href="" class="position-absolute top-0 end-0 m-0 text-danger mx-2"><i
                                class="bi bi-x-circle-fill fs-4"></i></a>
                        <div class="card-body text-white m-0">
                            <h5 class="card-title fw-bold">Higher Power</h5>
                            <h6 class="">Coldplay</h6>
                        </div>
                    </div>

                </li>
            </ul>
        </div>
    </div>

@endsection
