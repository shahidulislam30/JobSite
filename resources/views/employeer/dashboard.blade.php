@extends('master.layout')
@section('page-title','Dashboard')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="text-left text-capitalize m-0">Dashboard</h3>
            <a href="{{route('job.create')}}" class="btn btn-primary btn-sm">Add Job</a>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Job Title</h4>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Applicant Name</h4>
                            </div>
                            <div class="col-md-6">
                                <h4> Action</h4>
                            </div>
                        </div>
                    </div>
                </div>
               @forelse($jobs as $job)
                   <div class="row mb-3 border-bottom">
                       <div class="col-md-4">
                           {{$job->job_title}}
                       </div>
                       <div class="col-md-8">
                           @foreach($job->applyJobs as $applyJobs)
                           <div class="row mb-2 border-bottom pb-2">
                               <div class="col-md-6">
                                   {{$applyJobs->applicants->first_name.' '.$applyJobs->applicants->last_name}}
                               </div>
                               <div class="col-md-6">
                                   <a href="{{route('profile').'?id='.encrypt($applyJobs->applicants->id)}}" class="btn btn-info btn-sm">View Profile</a>

                                   <a href="{{asset($applyJobs->applicants->resume->path ?? '')}}" download="{{$applyJobs->applicants->first_name.' '.$applyJobs->applicants->last_name}} resume" class="btn btn-info btn-sm">Download Resume</a>
                               </div>
                           </div>
                           @endforeach
                       </div>
                   </div>
                   @empty

                       <h3 class="text-center">No Job Found</h3>

               @endforelse
            <div class="mt-3 text-center">{{$jobs->links()}}</div>
        </div>
    </div>
    @endsection
