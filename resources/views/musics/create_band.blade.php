@extends('layouts.musicBar')
@section('contentPage')
    <div class="container-fluid d-flex col-8 col-md-10 me-0 ps-1 pe-0">
        <div class="container-fluid mx-auto ps-2 bg-gray rounded-3 ">
            <div class="mb-3 mt-4 mx-2 bg-gray border-0 mx-auto" style="max-width: 750px;">
                <div class="row col-md-6 mx-auto">
                    <div class="">
                        <form class="text-white" action="{{route('store_band')}}" method="POST">
                            @csrf
                            <div class="position-relative">
                                <img src="{{asset('files/img/musicCoverDefault.png')}}" id="imageExample"
                                     class="img-fluid rounded" alt="...">
                                <button class="position-absolute btn bg-gray rounded-circle bottom-0 end-0 m-2"
                                        type="button">
                                    <label class="bi bi-folder-plus fs-4 d-inline-block m-auto text-white"
                                           for="inputFile">
                                        <input type="file" accept="image/*" name="band_image" hidden id="inputFile"
                                               class="is-invalid"
                                               onchange="document.getElementById('imageExample').src = window.URL.createObjectURL(this.files[0])">
                                    </label>
                                </button>
                            </div>
                            @error('band_image')
                            <div class="alert alert-danger" role="alert">
                                Image file Invalid!
                            </div>

                            @enderror
                            <div class="mb-3">
                                <label for="inputName_band" class="form-label">Nome da Banda</label>
                                <input name="band_name" type="text" class="form-control" id="inputName_band"
                                       aria-describedby="emailHelp" placeholder="Band">
                            </div>
                            @error('band_name')
                            {{ $message }}
                            @enderror
                            <div class="mb-3">
                                <label for="inputBand_foundedAt" class="form-label">Band Founded At</label>
                                <input name="band_released_at" type="date" class="form-control" id="inputBand_foundedAt"
                                       aria-describedby="emailHelp">
                            </div>
                            @error('band_released_at')
                            {{ $message }}
                            @enderror
                            <div class="mb-2 d-flex flex-column">
                                <label for="inputBand_genres" class="form-label">Country of the Band</label>
                                <select class="selectpicker w-100"
                                        data-actions-box="true" name="country_band"
                                        id="inputPais" data-live-search="true" title="Choose the country"
                                        data-live-search-placeholder="Search" data-size="5"
                                        data-selected-text-format="values">
                                    @foreach($paises as $pais)
                                        <option value="{{$pais->id}}">{{$pais->name}}</option>
                                    @endforeach
                                </select>
                                @error('country_band')
                                {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-2 d-flex flex-column">
                                <label for="inputBand_genres" class="form-label">Genres</label>
                                <select class="selectpicker w-100"
                                        onchange="addGenreToList()" data-actions-box="true" name="inputGenres[]"
                                        id="selectInput" data-live-search="true" title="Add Multiple Genres"
                                        data-live-search-placeholder="Search" multiple
                                        data-selected-text-format="static">
                                    @foreach($genres as $genre)
                                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                                    @endforeach
                                </select>
                                @error('inputGenres.*')
                                {{ $message }}
                                @enderror
                            </div>
                            <ul class="row m-0 p-0 " id="listInputGenres">
                            </ul>
                            <button type="submit" class="btn btn-primary w-100 mt-3">Criar Banda</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
