<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    public function applicants(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function jobs(){
        return $this->belongsTo(Job::class,'job_id');
    }

}
