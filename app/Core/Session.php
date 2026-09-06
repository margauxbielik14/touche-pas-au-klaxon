<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Manages the PHP session.
 */
class Session
{
    /**
     * Starts the session if it is not already active.
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Stores a value in the session.
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Returns a value stored in the session.
     */
    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Removes a value from the session.
     */
    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroys the current session.
     */
    public static function destroy(): void
    {
        $_SESSION = [];

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}