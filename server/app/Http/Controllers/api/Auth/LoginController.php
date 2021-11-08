<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
//    protected $auth;
//    public function __construct(JWTAuth $auth)
//    {
//        $this->auth = $auth;
//    }

    public function login(Request $request)
    {
        try {
            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'status' => 402,
                    'error' => [
                        'email' => 'Invalid email or password1'
                    ]
                ]);
            }
//            if ($token = auth('api')->login(User::first())) {
//                return response()->json([
//                    'success' => true,
//                    'user' => new UserResource(auth('api')->user()),
//                    'token' => $token
//                ], 200);
//
//            } else {
//                return response()->json([
//                    'success' => false,
//                    'error' => [
//                        'email' => 'Invalid email or password'
//                    ]
//                ]);
//            }
            if ($token = auth('api')->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'user' => new UserResource(auth('api')->user()),
                    'token' => $token
                ]);

            } else {
                return response()->json([
                    'status' => 403,
                    'success' => false,
                    'error' => [
                        'email' => 'Invalid email or password'
                    ]
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => 500,
                'success' => false,
                'error' => [
                    'email' => 'Invalid email or password'
                ]
            ]);
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:3'],
        ]);
    }
}
