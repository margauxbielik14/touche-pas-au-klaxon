<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Provides authentication and authorization helpers.
 */
class Auth
{
    /**
     * Returns the currently authenticated user.
     *
     * @return array<string, mixed>|null
     */
    public static function user(): ?array
    {
        $user = Session::get('user');

        return is_array($user) ? $user : null;
    }

    /**
     * Checks whether a user is authenticated.
     */
    public static function check(): bool
    {
        return self::user() !== null;
    }

    /**
     * Redirects anonymous visitors to the login page.
     */
    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Checks whether the authenticated user is an administrator.
     */
    public static function isAdmin(): bool
    {
        $user = self::user();

        return $user !== null
            && ($user['role'] ?? null) === 'ADMIN';
    }

    /**
     * Restricts access to administrators.
     */
    public static function requireAdmin(): void
    {
        if (!self::isAdmin()) {
            http_response_code(403);

            echo 'Accès interdit';

            exit;
        }
    }
}