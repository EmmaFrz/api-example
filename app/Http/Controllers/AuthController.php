<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateLoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function signup(CreateUserRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Successfully created user!'], 201);
    }

    public function login(CreateLoginRequest $request)
    {

        $credentials = request(['email', 'password']);

        if (Auth::attempt($credentials)) 
        {
	        $user = $request->user();
	        $tokenResult = $user->createToken('Personal Access Token');
	        $token = $tokenResult->token;

	        if ($request->remember_me) 
            {
	            $token->expires_at = Carbon::now()->addWeeks(1);
	        }

	        $token->save();

	        return response()->json([
	            'access_token' => $tokenResult->accessToken,
	            'token_type'   => 'Bearer',
	            'expires_at'   => Carbon::parse(
	                $tokenResult->token->expires_at)
	                    ->toDateTimeString(),
	        ]);

        }else

        {
        	return response()->json([
                'message' => 'Unauthorized'], 401);
        }

    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 
            'Successfully logged out']);
    }


    public function user(Request $request)
    {
        return $request->user();
    }
}