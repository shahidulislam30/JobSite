<?php

namespace App\Http\Controllers;

use App\Model\ApplyJob;
use App\Model\Job;
use App\Model\Resume;
use App\Model\User;
use Illuminate\Http\Request;

class ApplyJobController extends Controller
{
    public function store($id)
    {
        $jobId = decrypt($id);

        $job = Job::find($jobId);
        if (empty($job)){
            session()->flash('error','Invalid job');
            return redirect()->back();
        }

        $resume = Resume::where('user_id','=',auth()->id())->first();
        if (empty($resume->path)){
            session()->flash('error','Please upload your resume and edit profile.');
            return redirect()->route('profile');
        }

        $applyJob = ApplyJob::where('job_id','=',$jobId)->where('user_id','=',auth()->id())->first();
        if ($applyJob){
            session()->flash('warning','You already apply for this job');
            return redirect()->back();
        }else{
            $applyJobN = new ApplyJob();
            $applyJobN->user_id = auth()->id();
            $applyJobN->job_id = $jobId;
            if ($applyJobN->save()){
                session()->flash('success','Job application successfully submitted');
                return redirect()->back();
            }else{
                session()->flash('error','Job application faild');
                return redirect()->back();
            }
        }
    }


}
