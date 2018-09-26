<?php

namespace App;

use App\Job;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	protected $guarded = [];


	public function user(){
		return $this->belongsTo(User::class);
	}
}
