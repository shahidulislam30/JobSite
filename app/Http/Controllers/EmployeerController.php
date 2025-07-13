<?php

namespace App\Http\Controllers;

use App\Model\Job;
use Illuminate\Http\Request;

class EmployeerController extends Controller
{
    public function dashboard(){
        $jobs = Job::select('id','job_title')
            ->with('applyJobs','applyJobs.applicants','applyJobs.applicants.resume')
            ->where('user_id','=',auth()->id())
            ->paginate(20);
        return view('employeer.dashboard',compact('jobs'));
    }
}
