@extends('master.layout')
@section('page-title','Registration')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center text-capitalize">Registration</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('register')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <label for="first_name" class="font-weight-bold">First Name</label>
                                    <input type="text" id="first_name" class="form-control" placeholder="Enter Your First Name" name="first_name" value="{{old('first_name')}}" />
                                    @error('first_name')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="last_name" class="font-weight-bold">Last Name</label>
                                    <input type="text" id="last_name" class="form-control" placeholder="Enter Your Last Name" name="last_name" value="{{old('last_name')}}" />
                                    @error('last_name')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

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
                            <label for="User_type" class="font-weight-bold">User Type</label>
                            <select type="text" id="User_type" class="form-control" name="user_type">
                                <option selected disabled>Select User Type</option>
                                <option value="0">Applicant</option>
                                <option value="1">Employeer</option>
                            </select>
                            @error('user_type')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div id="business-name-holder">
                            <label for="business_name" class="font-weight-bold">Company Name</label>
                            <input type="text" id="business_name" class="form-control" placeholder="Enter Your Company Name" name="business_name"  value="{{old('business_name')}}" />
                            @error('business_name')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <label for="password" class="font-weight-bold">Password</label>
                                    <input type="password" id="password" class="form-control" placeholder="Enter Your Password" name="password"/>
                                    @error('password')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="confirm_password" class="font-weight-bold">Confirm Password</label>
                                    <input type="password" id="confirm_password" class="form-control" placeholder="Enter Your Password" name="confirm_password" />
                                    @error('confirm_password')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <p class="m-0">
                                Already have an accont? Please <a href="{{route('login.view')}}">Login</a>
                            </p>
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('change','#User_type',function () {
               var userType = parseInt($(this).val());
               if (userType === 0){
                   $('#business-name-holder').css('display','none')
               }else{
                   $('#business-name-holder').css('display','block')
               }
            })
        });
    </script>
    @endsection


