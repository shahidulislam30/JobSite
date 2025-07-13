@extends('master.layout')
@section('page-title','Add Job')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center text-capitalize">Add Job</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('job.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="job_title" class="font-weight-bold">Job Title</label>
                                <input type="text" id="job_title" class="form-control" placeholder="Enter Job Title" name="job_title" value="{{old('job_title')}}" />
                                @error('job_title')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="job_description" class="font-weight-bold">Job Description</label>
                                <textarea type="text" id="job_description" class="form-control" placeholder="Enter Job Description" name="job_description">{{old('job_description')}}</textarea>
                                @error('job_description')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="salary" class="font-weight-bold">Salary</label>
                                <input type="number" id="salary" class="form-control" placeholder="Salary" name="salary" value="{{old('salary')}}" step="any"/>
                                @error('salary')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="location" class="font-weight-bold">Location</label>
                                <input type="text" id="location" class="form-control" placeholder="Location" name="location" value="{{old('location')}}"/>
                                @error('location')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="country" class="font-weight-bold">Country</label>
                                <input type="text" id="country" class="form-control" placeholder="Country" name="country" value="{{old('country')}}"/>
                                @error('country')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-2 text-right">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
