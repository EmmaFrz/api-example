<?php

namespace App\Http\Controllers;
use App\User;
use App\Review;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    //CRUD PARAMETERS, 
    public function index()
    {
        $user = User::orderBy('id','desc')->paginate(10);
        $user->load('jobs','reviews');

        return $user;
    }

    public function show(User $user)
    {
        $user->load('jobs','reviews');

        return $user;   
    }


    public function delete(User $user)
    {
        if($job->user_id == $request->user()->id || $request->user()->hasRole('admin')){
        	$user->delete();
        	return $user;
        }else{
            return response()->json([
                'message' => 'You do not allowed to do this action'
            ],403);
        }
    }

    public function update(Request $request, User $user)
    {
        if($job->user_id == $request->user()->id || $request->user()->hasRole('admin')){
            $user->update($request->all());      
            return response()->json($user,200);
        }else{
            return response()->json([
                'message' => 'You do not allowed to do this action'
            ],403);
        }
    }    

}
