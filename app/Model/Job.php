<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function applyJobs(){
        return $this->hasMany(ApplyJob::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
