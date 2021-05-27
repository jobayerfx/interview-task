<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token, 'message' => 'Registration Successful']);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error' => true, 'error_message' => 'Incorrect credential. Please try again'], 200);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token, 'message' => 'Login Successful'], 201);
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function user_list()
    {
        $users = User::all();
        return response([ 'users' => UserResource::collection($users), 'message' => 'Successful'], 200);
    }

    public function user_details($id)
    {
        $user = User::find($id);
//        dd($user->roles[0]->role->name);
        return response([ 'user' => $user, 'message' => 'Successful'], 200);
    }

}
