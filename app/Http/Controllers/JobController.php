<?php

namespace App\Http\Controllers;
use App\Job;
use App\Http\Requests\CreateJobRequest;
use Illuminate\Http\Request;

class JobController extends Controller
{
   public function index(){
   		$job = Job::orderBy('id','desc')->get();
   		$job->load('user');
   		return $job;
   }

   public function show (Job $job){
   		$job->load('user');

   		return $job;		
   }

   public function store(CreateJobRequest $request){
   		try {
   			$job = Job::create([
   				'name' => $request->input('name'),
   				'description' => $request->input('description'),
   				'price' => $request->input('price'),
   				'user_id' => '5'
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

   public function update(Request $request, Job $job){
   		$job->update($request->all());

   		return response()->json($job,200);
   }

   public function delete(Job $job){
   		$job->delete();
   		
   		return $job;	
   }

}
