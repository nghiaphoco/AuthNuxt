<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;

class MeController extends Controller
{
//    protected $auth;
//    public function __construct(JWTAuth $auth)
//    {
//        $this->auth = $auth;
//    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => new UserResource(auth('api')->user())
        ]);
    }

    public function logout()
    {
    }
}
