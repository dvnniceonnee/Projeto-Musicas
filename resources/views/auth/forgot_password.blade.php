@extends('layouts.master')
@section('content')
    <div class="mt-3 loginBackground rounded py-5 h-100 container-fluid">
        <div class="row my-5">
            <div class="d-flex align-items-center col-5 bg-white rounded py-5 px-2 mx-auto my-auto text-center ">
                <div class="d-flex flex-column my-5 w-75 mx-auto">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            Pedido de reset à password enviado!
                        </div>
                    @endif
{{--                    @if(session())--}}
{{--                        {{dd(session())}}--}}
{{--                    @endif--}}
                    <h2>
                        Request a reset to your Password
                    </h2>
                    <form class="my-auto mt-4" action="{{route('password.email')}}" method="Post">
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="inputEmail" class="mb-2">Email</label>
                            <input name="email" type="email" class="form-control"
                                   placeholder="Email"
                                   id="inputEmail">
                            @error('email')
                            <span class="badge text-bg-danger">Email Inexistente</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-secondary mt-4 w-50 rounded-2">Request Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
