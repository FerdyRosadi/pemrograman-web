<?php
declare(strict_types=1);

final class Router
{
    private array $routes = [];

    public function add(string $method, string $path, callable $handler): void
    {
        $this->routes[] = [$method, $path, $handler];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        $script = dirname($_SERVER['SCRIPT_NAME'] ?? '');
        if ($script !== '/' && $script !== '.' && str_starts_with($path, $script)) {
            $path = substr($path, strlen($script));
        }
        if ($path === '' || $path === false) {
            $path = '/';
        }
        if (($path === '/' || $path === '/index.php') && isset($_GET['url'])) {
            $path = '/' . trim((string) $_GET['url'], '/');
        }

        foreach ($this->routes as [$routeMethod, $routePath, $handler]) {
            if ($method === $routeMethod && $path === $routePath) {
                $handler();
                return;
            }
        }

        http_response_code(404);
        echo '404 - Halaman tidak ditemukan.';
    }
}