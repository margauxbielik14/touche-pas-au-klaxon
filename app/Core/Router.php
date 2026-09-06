<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Handles application routes.
 */
class Router
{
    /**
     * @var array<string, callable>
     */
    private array $getRoutes = [];

    /**
     * @var array<string, callable>
     */
    private array $postRoutes = [];

    /**
     * Registers a GET route.
     */
    public function get(string $path, callable $callback): void
    {
        $this->getRoutes[$path] = $callback;
    }

    /**
     * Registers a POST route.
     */
    public function post(string $path, callable $callback): void
    {
        $this->postRoutes[$path] = $callback;
    }

    /**
     * Executes the route matching the current request.
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $path = parse_url(
            $_SERVER['REQUEST_URI'] ?? '/',
            PHP_URL_PATH
        );

        if (!is_string($path)) {
            $path = '/';
        }

        $routes = $method === 'POST'
            ? $this->postRoutes
            : $this->getRoutes;

        foreach ($routes as $route => $callback) {
            $pattern = preg_replace(
                '#\{id\}#',
                '([0-9]+)',
                $route
            );

            if ($pattern === null) {
                continue;
            }

            if (preg_match('#^' . $pattern . '$#', $path, $matches)) {
                array_shift($matches);

                $callback(...$matches);

                return;
            }
        }

        http_response_code(404);

        echo 'Page introuvable';
    }
}