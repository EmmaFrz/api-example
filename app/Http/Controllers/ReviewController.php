<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Http\Requests\CreateReviewRequest;

class ReviewController extends Controller
{
    public function create(CreateReviewRequest $request){

    	$review = Review::create([
    		'content' => $request->input('content'),
    		'user_id' => $request->user()->id,
    		'job_id' => $request->input('job_id'),
    	]);

    	return $review;
    }
}
