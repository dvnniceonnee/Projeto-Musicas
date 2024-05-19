@extends('layouts.master')
@section('content')
    <div class="mt-3 loginBackground rounded py-5 vh-100">
        <div class="d-flex flex-column flex-md-row col-10 my-auto h-100 m-auto">
            <div class="d-flex align-items-center col-10 col-md-5 bg-white rounded-start py-5 px-2 mx-auto text-center me-md-0 ">
                <div class="d-flex flex-column my-5 w-75 mx-auto">
                    @if(session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <h2>
                        Login to Your Account
                    </h2>
                    <form class="my-auto mt-4" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" placeholder="Email">
                            <div id="emailHelp" class="form-text text-start">We'll never share your email with anyone
                                else.
                            </div>
                            @error('email')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                   id="exampleInputPassword1">
                        </div>
                        <div class="mb-3 form-check text-start">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-secondary mt-4 w-50 rounded-3">LOGIN</button>
                    </form>
                </div>
            </div>
            <div class="d-flex align-items-center col-10 col-md-3 bg-gray text-white text-center rounded-end ms-md-0 mx-auto">
                <div class="d-flex flex-column mx-auto w-50 opacity-100">
                    <h1 class="my-3">New Here?</h1>
                    <span class="my-3 fs-5">Sign up and discover a great amount of new opportunities!</span>
                    <a class="btn btn-warning rounded-5 my-3" href="{{route('register')}}">Sign Up!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
