<?php

namespace App;
use App\Job;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];


    public function job(){
    	return $this->belongsTo(Job::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
