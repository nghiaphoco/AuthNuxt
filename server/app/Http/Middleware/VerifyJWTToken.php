<?php

namespace App\Http\Middleware;

use App\User;
use Carbon\Carbon;
use Closure;
use Cache;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class VerifyJWTToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = [
            'status' => false,
            'message' => 'User Not Found',
            'data' => [],
            'code' => ''
        ];
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user) {
                return response()->json($response);
            }
        } catch (Exception $e) {
            if($e instanceof TokenInvalidException) {
                $response['message'] ='Token invalid';
            } else if($e instanceof TokenExpiredException) {
                $response['message'] = 'Token expired';
            } else {
                $response['message'] = 'Authorization Token not found';
            }

            $response['code'] = JsonResponse::HTTP_UNAUTHORIZED;
            return response()->json($response);
        }

        return $next($request);
    }
}
