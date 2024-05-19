@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row p-0">
            <div class="container-fluid col-12 col-md-4 p-1 pt-0 mx-auto">
                <div class="d-flex flex-column p-3 text-white bg-gray rounded">
                    <div class="">
                        <h4 class="btn btn-secondary rounded-pill w-100">Lista de Bandas</h4>
                    </div>
                    <div class="text-white mx-1">
                        <table id="TableBands" class="text-white text-center align-middle">
                            <thead>
                            <tr>
                                <th class="align-content-center">Cover</th>
                                <th class="text-center">Band Name</th>
                                <th class="text-center">Founded at</th>
                                <th class="text-center">Founded in</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                            @foreach($allBands as $band)
                            <tr>
                                <td class="p-1"><img src="{{asset('storage/'.$band->photo)}}"
                                                             class="w-50 rounded-3 d-block mx-auto" alt=""></td>
                                <td>{{$band->name}}</td>
                                <td>{{$band->founded_in}}</td>
                                <td class="text-center">{{$band->founded_at}}</td>
                                <td>
                                    <button class="btn btn-warning rounded-circle px-1 py-0"><i
                                            class="bi bi-pencil-square"></i></button>
                                </td>
                                <td>
                                    <button class="btn btn-danger rounded-circle px-1 py-0"><i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="container-fluid col-12 col-md-4 p-1 pt-0 ">
                <div class="d-flex flex-row p-3 text-white bg-gray rounded">
                    <div class="text-white mx-1">
                        <table id="TableAlbums" class="text-white text-center align-middle">
                            <thead>
                            <tr>
                                <th class="text-center">Cover</th>
                                <th class="text-center">Band Name</th>
                                <th class="text-center">Founded at</th>
                                <th class="text-center">Founded in</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                            <tr>
                                <td class="p-1 d-block"><img src="{{asset('files/img/musicCover1.png')}}"
                                                             class="w-50 rounded-3 d-block mx-auto" alt=""></td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td class="text-center">61</td>
                                <td>
                                    <button class="btn btn-warning rounded-circle px-1 py-0"><i
                                            class="bi bi-pencil-square"></i></button>
                                </td>
                                <td>
                                    <button class="btn btn-danger rounded-circle px-1 py-0"><i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container-fluid col-12 col-md-4 p-1 pt-0 ">
                <div class="d-flex flex-row p-3 text-white bg-gray rounded">
                    <div class="text-white mx-1">
                        <table id="TableMusics" class="text-white text-center col-4 w-75 align-middle">
                            <thead>
                            <tr>
                                <th class="text-center">Cover</th>
                                <th class="text-center">Band Name</th>
                                <th class="text-center">Founded at</th>
                                <th class="text-center">Founded in</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                            <tr>
                                <td class="p-1"><img src="{{asset('files/img/musicCover1.png')}}"
                                                     class="w-50 mx-auto rounded-3" alt=""></td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td class="text-center">61</td>
                                <td>
                                    <button class="btn btn-warning rounded-circle px-1 py-0"><i
                                            class="bi bi-pencil-square"></i></button>
                                </td>
                                <td>
                                    <button class="btn btn-danger rounded-circle px-1 py-0"><i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
