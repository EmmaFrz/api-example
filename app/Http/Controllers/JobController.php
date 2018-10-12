<?php

namespace App\Http\Controllers;
use App\Job;
use App\Review;
use App\Http\Requests\CreateJobRequest;
use Illuminate\Http\Request;

class JobController extends Controller
{
   public function index()
   {
   		$job = Job::orderBy('id','desc')->paginate(10);
   		$job->load('user','category','reviews');
   		return $job;
   }

   public function show (Job $job){
   		$job->load('user','category','reviews');

   		return $job;		
   }

   public function store(CreateJobRequest $request)
   {	 
         try {
   			$job = Job::create([
   				'name' => $request->input('name'),
   				'description' => $request->input('description'),
   				'price' => $request->input('price'),
   				'user_id' => $request->user()->id,
               'category_id' => $request->input('category')
   			]);

   		$response['status'] = true;
   		$responde['message'] = 'Success';

   		return response()->json($job,201);	

   		} catch (\Illuminate\Database\QueryException $ex) {
    		$response['status'] = false;
            $response['message'] = $ex->getMessage();
            return response($response, 500);
    	   }
   }

   public function update(Request $request, Job $job)
   {
   		if($job->user_id == $request->user()->id){
            
            $job->update($request->all());
      
      		return response()->json($job,200);
         }else{
            return response()->json([
               'message' => 'User not allowed'
            ],401);
         }
   }

   public function delete(Request $request, Job $job)
   {
   		if($job->user_id == $request->user()->id)
         {
            $job->delete();
   		   return $job;
         }else{
            return response()->json([
               'message' => 'user not allowed'
            ],401);
         }
   }

}
