<?php

namespace App\Http\Controllers;

use App\Model\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{

    public function create()
    {
        return view('job.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'job_title' => 'required|max:100',
            'job_description' =>'required|max:1500',
            'salary' =>'required|numeric',
            'location' =>'required',
            'country' =>'required',
        ];

        $message = [];

        $validation = Validator::make($request->all(),$rules,$message);

        if ($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }else{
            $job = new Job();
            $job->job_title = $request->job_title;
            $job->job_description = $request->job_description;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->country = $request->country;
            $job->user_id = auth()->id();
            if ($job->save()){
                session()->flash('success','Job created.');
                return redirect()->route('dashboard');
            }else{
                session()->flash('error','Unable to create job.');
                return redirect()->back()->withInput();
            }
         }
    }
    public function show($id)
    {
        $jobId = decrypt($id);
        $job = Job::with('user')->find($jobId);
        if (empty($job)){
            session()->flash('error','Invalid job');
            return redirect()->back();
        }
        return view('job.show',compact('job'));
    }

}
