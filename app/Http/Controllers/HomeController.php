<?php

namespace App\Http\Controllers;

use App\Model\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function indxe(){
        $jobs = Job::select('id','job_title','user_id','location','country')->with('user')->paginate(20);
        return view('index',compact('jobs'));
    }
}
