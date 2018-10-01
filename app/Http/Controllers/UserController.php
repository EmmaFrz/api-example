<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    //CRUD PARAMETERS, 
    public function index()
    {
        $user = User::orderBy('id','desc')->get();
        $user->load('jobs');

        return $user;
    }

    public function show(User $user)
    {
        $user->load('jobs');

        return $user;   
    }


    public function delete(User $user)
    {
    	$user->delete();

    	return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json($user,200);
    }    

}
