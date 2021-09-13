<?php

declare(strict_types = 1);

namespace App\Http\Procedures;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\AuthResponse;
use App\Models\User;
use App\Traits\JWT;
use Illuminate\Support\Facades\Auth;
use Sajya\Server\Procedure;
use Symfony\Component\HttpFoundation\Response;

class AuthProcedure extends Procedure
{
    use JWT;

    /**
     * The name of the procedure that will be
     * displayed and taken into account in the search
     *
     * @var string
     */
    public static string $name = 'auth';

    /**
     * @param LoginRequest $request
     * @return string
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        try {
            if (!$user = $data['user']) {
                return AuthResponse::USER_NOT_FOUND;
            }

            if (!$jwt = $this->generateToken($data['credentials'], $data['remember'] ?? false)) {
                return AuthResponse::WRONG_CREDENTIALS;
            }

            $user->update(compact('jwt'));
        } catch (\Exception $exception) {
            return Response::$statusTexts[500];
        }
        return compact('user');
    }

    /**
     * @param RegisterRequest $request
     * @return string
     */
    public function register(RegisterRequest $request): string
    {
        try {
            User::create($request->validated());
        } catch (\Exception $exception) {
            return Response::$statusTexts[500];
        }
        return AuthResponse::REGISTER_SUCCESS;
    }

    /**
     * @return string
     */
    public function user()
    {
        if (Auth::check()) {
            $user = User::where('jwt', request()->bearerToken())
                ->first(['id', 'username', 'email', 'jwt']);
            return compact('user');
        }

        return AuthResponse::UNAUTHORIZED;
    }
}
