@extends('master.layout')
@section('page-title',$user->first_name?? '')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="text-left text-capitalize m-0">{{(auth()->id() != $user->id) ? $user->first_name: 'Your'}} Profile</h3>
            @if(auth()->id() == $user->id)
            <a href="{{route('profile.edit')}}" class="btn btn-primary btn-sm">Edit Profile</a>
                @endif

        </div>
        <div class="card-body">
            <h5 class="card-title">Basic Info</h5>
               <div class="row">
                   <div class="col-md-3 text-center">
                        @if(!empty($user->profilePhoto->picture))
                            <img class="w-75" src="{{asset($user->profilePhoto->picture)}}" />
                            @else
                            <p class="text-danger">Photo Not Uploaded</p>
                       @endif
                   </div>
                   <div class="col-md-9">
                        <table class="table">
                            <tr>
                                <th>First Name</th>
                                <td>{{$user->first_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>{{$user->last_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$user->email ?? ''}}</td>
                            </tr>
                        </table>
                   </div>
               </div>
            <h5 class="card-title my-3">Skills</h5>
            <div class="row">
                @foreach($user->skills as $skill)
                <div class="col-md-6">
                    <p class="mb-1">{{$skill->skill_name}}</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{$skill->skill_value}}%;" aria-valuenow="{{$skill->skill_value}}" aria-valuemin="0" aria-valuemax="100">{{$skill->skill_value}}%</div>
                    </div>
                </div>
                    @endforeach
            </div>

            <h5 class="card-title my-3">Resume</h5>
            <div class="text-center">
                @if(!empty($user->resume->path))
                <a class="btn btn-sm btn-info" href="{{asset($user->resume->path)}}" download="{{$user->first_name}}">Download Resume</a>

                    @if(auth()->id() != $user->id)
                        <a class="btn btn-sm btn-primary" href="{{URL::previous()}}">Back</a>
                        @endif

                    @else
                    <p class="text-center">Resume not Uploaded</p>
                @endif
            </div>
        </div>
    </div>
@endsection
