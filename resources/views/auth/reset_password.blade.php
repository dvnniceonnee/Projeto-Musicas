@extends('layouts.master')
@section('content')
    <div class="mt-3 loginBackground rounded py-5 h-100 container-fluid">
        <div class="row my-5">
            <div class="d-flex align-items-center col-5 bg-white rounded py-5 px-2 mx-auto my-auto text-center ">
                <div class="d-flex flex-column my-5 w-75 mx-auto">
                    <h2 class="">
                        Password account password
                    </h2>
                    <form class="my-auto mt-4" action="{{route('password.update')}}" method="Post">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        <div class="mb-3 text-start">
                            <label for="inputEmail" class="mb-2">Email</label>
                            <input name="email" type="email" class="form-control"
                                   placeholder="Email" value="{{request()->email}}"
                                   id="inputEmail">
                            @error('email')
                            <span class="badge text-bg-danger">Email Inválido</span>
                            @enderror
                        </div>
                        <div class="mb-3 text-start">
                            <label for="inputPassword" class="mb-2">Password</label>
                            <input name="password" type="password" class="form-control"
                                   placeholder="Password"
                                   id="inputPassword">
                            @error('password')
                            <span class="badge text-bg-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 text-start">
                            <label for="inputPassword_confirmation" class="mb-2">Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control"
                                   placeholder="Password"
                                   id="inputPassword_confirmation">
                        </div>
                        <button type="submit" class="btn btn-secondary mt-4 w-50 rounded-2">Reset password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
