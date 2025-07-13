@extends('master.layout')
@section('page-title','Edit Profile')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center text-capitalize">Profile Edit</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <h5 class="card-title border-bottom">Basic Info</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="first_name" class="font-weight-bold">First Name</label>
                                <input type="text" id="first_name" class="form-control" placeholder="Enter Your First Name" name="first_name" value="{{old('first_name',$user->first_name ?? '')}}" />
                                @error('first_name')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="font-weight-bold">Last Name</label>
                                <input type="text" id="last_name" class="form-control" placeholder="Enter Your Last Name" name="last_name" value="{{old('last_name',$user->last_name ?? '')}}" />
                                @error('last_name')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" id="email" class="form-control" placeholder="Enter Your Email" name="email" value="{{old('email',$user->email ?? '')}}" />
                                @error('email')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>

                        <h5 class="card-title border-bottom mt-3">Skills</h5>
                            <div class="row">
                                <div class="col-md-12" id="skill-holder">
                                    @if(count($user->skills) > 0)
                                        @foreach($user->skills as $skill)
                                        <div class="row" >
                                            <div class="col-md-6">
                                                <label for="skill_name[]" class="font-weight-bold">Skill Name</label>
                                                <input type="text" id="skill_name" class="form-control" placeholder="" name="skill_name[]" value="{{$skill->skill_name}}" />
                                            </div>

                                            <div class="col-md-5">
                                                <label for="skill_value" class="font-weight-bold">Skill Value(Out of 100)</label>
                                                <input type="number" id="skill_value" class="form-control" placeholder="" name="skill_value[]" value="{{$skill->skill_value}}" max="100"/>
                                            </div>
                                            <div class="col-md-1" style="padding-top: 34px">
                                                <button class="remove btn btn-danger btn-sm">X</button>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="row" >
                                            <div class="col-md-6">
                                                <label for="skill_name[]" class="font-weight-bold">Skill Name</label>
                                                <input type="text" id="skill_name" class="form-control" placeholder="" name="skill_name[]" value="" />
                                            </div>

                                            <div class="col-md-5">
                                                <label for="skill_value" class="font-weight-bold">Skill Value(Out of 100)</label>
                                                <input type="number" id="skill_value" class="form-control" placeholder="" name="skill_value[]" value="" max="100"/>
                                            </div>
                                            <div class="col-md-1" style="padding-top: 34px">
                                                <button class="remove btn btn-danger btn-sm">X</button>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="col-md-12 text-center">
                                    <button id="add-skill" type="button" class="btn btn-success btn-sm mt-3">+ Add Skill</button>
                                </div>
                            </div>

                        <h5 class="card-title border-bottom mt-3">Files</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="picture" class="font-weight-bold">Profile Photo</label>
                                <input type="file" id="picture" class="form-control" placeholder="Select Your Profile Picture" name="picture" value="" accept="image/x-png,image/gif,image/jpeg"/>
                                @error('picture')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="picture" class="font-weight-bold">Upoad Resume</label>
                                <input type="file" id="path" class="form-control" placeholder="Upload Your resume" name="path" value="" accept="application/pdf,application/msword,
  application/vnd.openxmlformats-officedocument.wordprocessingml.document"/>
                                @error('picture')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-2 d-flex justify-content-end align-items-center">
                            <a href="{{URL::previous()}}" class="btn btn-danger mr-2">Cancel</a>
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
            $(document).on('click','.remove',function () {
                $(this).closest("div.row").remove();
            });

            $(document).on('click','#add-skill',function () {
                $('#skill-holder').append(' <div class="row" >\n' +
                    '                                        <div class="col-md-6">\n' +
                    '                                            <label for="skill_name" class="font-weight-bold">Skill Name</label>\n' +
                    '                                            <input type="text" id="skill_name" class="form-control" placeholder="" name="skill_name[]" value="" />\n' +
                    '                                        </div>\n' +
                    '\n' +
                    '                                        <div class="col-md-5">\n' +
                    '                                            <label for="skill_value" class="font-weight-bold">Skill Value(Out of 100)</label>\n' +
                    '                                            <input type="number" id="skill_value" class="form-control" placeholder="" name="skill_value[]" value="" max="100"/>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-1" style="padding-top: 34px">\n' +
                    '                                            <button class="remove btn btn-danger btn-sm">X</button>\n' +
                    '                                        </div>\n' +
                    '                                    </div>');
            });
        });
    </script>
    @endsection


