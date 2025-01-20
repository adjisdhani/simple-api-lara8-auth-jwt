<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::info('JwtMiddleware triggered');

        try {
            Log::info('Trying to authenticate token');
            $user = JWTAuth::parseToken()->authenticate();

            Log::info('Token version usernya: ' . $user->token_version);

            // Validasi token versi
            if ($request->hasHeader('Authorization')) {
                $tokenPayload = JWTAuth::getPayload(JWTAuth::getToken());
                $tokenVersion = $tokenPayload->get('token_version');

                Log::info('Token version dari headernya: ' . $tokenVersion);

                if ($tokenVersion != $user->token_version) {
                    return response()->json(['error' => 'Token is invalid, please login again'], 401);
                }
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            Log::error('Token expired');
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            Log::error('Token invalid');
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            Log::error('Token not provided');
            return response()->json(['error' => 'Token not provided'], 401);
        }

        return $next($request);
    }

}
