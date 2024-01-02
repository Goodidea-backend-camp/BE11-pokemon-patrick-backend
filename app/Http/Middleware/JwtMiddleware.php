<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            // 如果无法验证令牌，返回错误响应
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // 将用户信息附加到请求中，以便在控制器中使用
        $request->attributes->add(['user' => $token]);

        return $next($request);
    }
}
