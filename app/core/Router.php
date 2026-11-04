<?php

class Router
{
    private array $routes = [];

    public function get(string $path, string|callable $action): void
    {
        $this->addRoute('GET', $path, $action);
    }

    public function post(string $path, string|callable $action): void
    {
        $this->addRoute('POST', $path, $action);
    }

    private function addRoute(string $method, string $path, string|callable $action): void
    {
        $path = '/' . trim($path, '/');
        $this->routes[] = [
            'method' => strtoupper($method),
            'path'   => $path,
            'action' => $action
        ];
    }

    public function dispatch(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

        // Normalize base path
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
        $basePath = rtrim($scriptDir, '/');

        $path = $requestUri;
        if (!empty($basePath) && strpos($requestUri, $basePath) === 0) {
            $path = substr($requestUri, strlen($basePath));
        } else {
            // Check if accessed through /magic-web (parent of public)
            $parentDir = dirname($basePath);
            if (!empty($parentDir) && $parentDir !== '/' && strpos($requestUri, $parentDir) === 0) {
                $path = substr($requestUri, strlen($parentDir));
                if (strpos($path, '/public') === 0) {
                    $path = substr($path, 7);
                }
            }
        }

        $path = '/' . trim($path, '/');

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $path) {
                $this->execute($route['action']);
                return;
            }
        }

        // Route not found
        http_response_code(404);
        echo "<!DOCTYPE html><html><head><title>404 Not Found</title>";
        echo "<style>body{background:#0b0c10;color:#f4f4f4;font-family:sans-serif;display:flex;align-items:center;justify-content:center;height:100vh;margin:0;flex-direction:column}h1{font-size:3rem;color:#d4af37;margin:0 0 10px}a{color:#d4af37;text-decoration:none;border:1px solid #d4af37;padding:10px 20px;border-radius:4px;margin-top:20px}</style></head>";
        echo "<body><h1>404</h1><p>The page you are looking for does not exist.</p><a href='" . (defined('BASE_URL') ? BASE_URL : '/') . "/'>Return to Home</a></body></html>";
    }

    private function execute(string|callable $action): void
    {
        if (is_callable($action)) {
            call_user_func($action);
            return;
        }

        if (is_string($action) && strpos($action, '@') !== false) {
            [$controllerName, $method] = explode('@', $action);
            $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $method)) {
                        $controller->$method();
                        return;
                    }
                }
            }
        }

        http_response_code(500);
        echo "500 - Server Error: Handler could not be executed.";
    }
}
