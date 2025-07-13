@extends('master.layout')
@section('page-title','Job Details')
@section('content')
    <div class="card">

        <div class="card-body">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$job->job_title ?? ''}}</h5>
                        <h6 class="card-title">Company: {{$job->user->business_name ?? ''}}</h6>

                        <h6 class="card-title">Job Description</h6>
                        <p>{{$job->job_description}}</p>

                        <p class="m-0">
                            <b>Location</b> <span>{{$job->location ?? ''}}</span>
                        </p>
                        <p class="m-0">
                            <b>Country</b> <span>{{$job->country ?? ''}}</span>
                        </p>
                        @if(!auth()->check() || auth()->user()->user_type != 1)
                            <a href="{{URL::previous()}}" class="btn btn-primary mt-2">Back</a>
                            <a href="{{route('apply.job',encrypt($job->id))}}" class="btn btn-primary mt-2">Apply</a>
                        @endif
                    </div>
                </div>
        </div>
    </div>
@endsection
