<?php


namespace App\Traits;


use Tymon\JWTAuth\Facades\JWTAuth;

trait JWT
{
    /**
     * @param array $credentials
     * @param bool $remember
     * @param int $ttl
     * @return false|string
     */
    private function generateToken(array $credentials, bool $remember = false, int $ttl = 1440)
    {
        if ($remember) {
            JWTAuth::factory()->setTTL($ttl);
        }

        return JWTAuth::attempt($credentials);
    }
}
