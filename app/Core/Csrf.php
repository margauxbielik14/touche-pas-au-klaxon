<?php

declare(strict_types=1);

namespace App\Core;

final class Csrf
{
    private const TOKEN_KEY = 'csrf_token';

    public static function token(): string
    {
        $token = Session::get(self::TOKEN_KEY);

        if (!is_string($token) || $token === '') {
            $token = bin2hex(random_bytes(32));
            Session::set(self::TOKEN_KEY, $token);
        }

        return $token;
    }

    public static function validate(?string $token): bool
    {
        $sessionToken = Session::get(self::TOKEN_KEY);

        if (
            !is_string($sessionToken)
            || !is_string($token)
            || $token === ''
        ) {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }

    public static function requireValid(?string $token): void
    {
        if (!self::validate($token)) {
            http_response_code(403);
            exit('Requête invalide.');
        }
    }
}