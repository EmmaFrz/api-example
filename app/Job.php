<?php

namespace App;

use App\Category;
use App\Job;
use App\Review;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	use SoftDeletes;

	protected $guarded = [];

	protected $date = ['deleted_at'];

	protected $hidden = ['deleted_at'];


	public function user(){
		return $this->belongsTo(User::class);
	}

	public function category(){
		return $this->belongsTo(Category::class);
	}

	public function reviews(){
		return $this->hasMany(Review::class);
	}
}
