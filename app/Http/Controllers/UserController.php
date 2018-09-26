<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
    	$user = User::orderBy('id','desc')->get();
        $user->load('jobs');

        return $user;
    }

    public function show(User $user){
    	$user->load('jobs');

        return $user;	
    }

    public function store(CreateUserRequest $request){
    	try {
        	$user = User::create([
        		'name' => $request->input('name'),
        		'email' => $request->input('email'),
        		'password' => Hash::make($request->input('password')),
        	]);

        $response['status'] = true;
        $response['message'] = 'Success';

        return response()->json($user,201);    		
    	} catch (\Illuminate\Database\QueryException $ex) {
    		$response['status'] = false;
            $response['message'] = $ex->getMessage();
            return response($response, 500);
    	}
    }

    public function delete(User $user){
    	$user->delete();

    	return $user;
    }

    public function update(Request $request, User $user){
        $user->update($request->all());

        return response()->json($user,200);
    }

}
