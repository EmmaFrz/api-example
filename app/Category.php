<?php

namespace App;

use App\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    protected $guarded = [];

    protected $date = ['delete_at'];

    public function jobs(){
    	return $this->hasMany(Job::class);
    }
}
