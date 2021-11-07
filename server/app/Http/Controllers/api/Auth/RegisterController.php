<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $auth;
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function register (Request $request)
    {
        $validator = $this->validator($request->all());
        if (!$validator->fails()) {
            $user = $this->create($request->all());
            $token = $this->auth->attempt($request->only('email', 'password'));
            return response()->json([
                'status' => true,
                'data' => $user,
                'token' => $token,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ]);
    }

    protected function validator (array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6:confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
