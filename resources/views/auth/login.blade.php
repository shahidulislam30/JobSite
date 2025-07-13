@extends('master.layout')
@section('page-title','Login')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center text-capitalize">Login</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('login')}}">
                        @csrf

                        <div>
                            <label for="email" class="font-weight-bold">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter Your Email" name="email" value="{{old('email')}}" />
                            @error('email')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="font-weight-bold">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter Your Password" name="password" />
                            @error('password')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <p class="m-0">
                                Don't have an accont? Please <a href="{{route('register.view')}}">Register</a>
                            </p>
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
