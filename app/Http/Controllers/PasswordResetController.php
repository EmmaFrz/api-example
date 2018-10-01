<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;

class PasswordResetController extends Controller
{
    public function create(Request $request)
    {
    	$request->validate([
    		'email' => 'required|email|string'
    	]);

    	$user = User::where('email',$request->email)->first();

    	if($user)
    	{
    		$PasswordReset = PasswordReset::updateOrCreate(
    			['email' => $request->email],
    			['email' => $request->email,'token' => str_random(60)]);
    		if($user && $PasswordReset)
    		{
    			$user->notify( new PasswordResetRequest($PasswordReset->token));
    		}

    		return response()->json(['message' => 'Search in your email for the password reset']);
    	}else{
    		return response()->json(['message' => 'Cannot find a user with this email'],402);
    	}
    }

    public function find($token)
    {
    	$PasswordReset = PasswordReset::where('token',$token)->first();

    	if(!$PasswordReset){
    		return response()->json([
    			'message' => 'Password token is invalid'
    		]);
    	}

    	if(Carbon::parse($PasswordReset->updated_at)->addMinutes(720)->isPast()){
    		$PasswordReset->delete();
    		return response()->json([
    			'message' => 'This token is expired'
    		]);
    	}
				
		return $PasswordReset;	
    }

    public function reset(Request $request)
    {
    	$request->validate([
    		'email' => 'required|string|email',
    		'password' => 'required|string|confirmed',
    		'token' => 'required|string'
    	]);

    	$PasswordReset = PasswordReset::where([
    		['token',$request->token],
    		['email',$request->email]
    	])->first();

    	if(!$PasswordReset){
    		return response()->json([
    			'message' => 'This password reset token is invalid'
    		],401);
    	}else{
    		$user = User::where('email',$PasswordReset->email)->first();

    		if(!$user){
    			return response()->json([
    				'message' => 'We cannot find a user wih that email'
    			],404);
    		}else{
    			$user->password = Hash::make($request->password);
    			$user->save();

    			$PasswordReset->delete();

    			$user->notify(new PasswordResetSuccess($PasswordReset));

    			return $user;
    		}
    	}
    }
}
