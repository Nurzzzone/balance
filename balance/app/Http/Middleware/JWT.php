<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\HasJsonResponse;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWT
{
    use HasJsonResponse;

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                return $this->sendUnauthorizedMessage('Токен недействителен!');
            } else if ($exception instanceof TokenExpiredException) {
                return $this->sendUnauthorizedMessage('Срок действия токена истек');
            } else {
                return $this->sendUnauthorizedMessage('Токен авторизации не найден!');
            }
        }

        return $next($request);
    }
}
