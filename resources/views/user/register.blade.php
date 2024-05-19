@extends('layouts.master')
@section('content')
    <div class="mt-3 loginBackground rounded py-5 h-100 container-fluid">
        <div class="row my-5">
            <div class="d-flex align-items-center col-5 bg-white rounded py-5 px-2 mx-auto my-auto text-center ">
                <div class="d-flex flex-column my-5 w-75 mx-auto">
                    <h2>
                        Create New Account
                    </h2>
                    <form class="my-auto mt-4" action="{{route('register_user')}}" method="Post">
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="inputFirst_name" class="mb-2">First Name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name')border-danger @enderror" id="inputFirst_name"
                                   aria-describedby="emailHelp" placeholder="First name">
                            @error('first_name')
                            <span class="badge text-bg-danger">Nome Inválido</span>
                            @enderror
                        </div>
                        <div class="mb-3 text-start">
                            <label for="inputLast_name" class="mb-2">Last name</label>
                            <input type="text" name="last_name" class="form-control " id="inputLast_name"
                                   placeholder="Last name">
                            @error('last_name')
                            <span class="badge text-bg-danger">Last name Inválido</span>
                            @enderror
                        </div>
                        <div class="mb-3 text-start">
                            <label for="inputEmail" class="mb-2">Email</label>
                            <input name="email" type="email" class="form-control"
                                   placeholder="Email"
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
                            <span class="badge text-bg-danger">Password Inválida</span>
                            @enderror
                        </div>
                        <div class="mb-3 text-start">
                            <label for="inputPassword_confirmation" class="mb-2">Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control"
                                   placeholder="Password"
                                   id="inputPassword_confirmation">
                            @error('password')
                            <span class="badge text-bg-danger">Password Inválida</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check text-start">
                            <input disabled type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Are you a admin?</label>
                        </div>
                        <button type="submit" class="btn btn-secondary mt-4 w-50 rounded-2">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
