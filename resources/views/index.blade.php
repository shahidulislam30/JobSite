@extends('master.layout')
@section('page-title','Home')
@section('content')
    <div class="card">

        <div class="card-body">
            <h5 class="card-title">job List</h5>
                @forelse($jobs as $job)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$job->job_title ?? ''}}</h5>
                        <h6 class="card-title">{{$job->user->business_name ?? ''}}</h6>
                        <p class="m-0">
                            <i class="fas fa-map-marker-alt"></i> <span>{{$job->location ?? ''}}</span>
                        </p>
                        <p class="m-0">
                            <i class="fas fa-globe-americas"></i> <span>{{$job->country ?? ''}}</span>
                        </p>
                        @if(!auth()->check() || auth()->user()->user_type != 1)
                            <a href="{{route('job.show',encrypt($job->id))}}" class="btn btn-primary mt-2">Job Details</a>
                            <a href="{{route('apply.job',encrypt($job->id))}}" class="btn btn-primary mt-2">Apply</a>
                        @endif
                    </div>
                </div>
                @empty
                        <h2 class="text-center">No Job Found</h2>

                @endforelse

            <div class="mt-3 text-center">{{$jobs->links()}}</div>
        </div>
    </div>
@endsection
