<?php

namespace App\Config;

class Router {
    private static array $routes = [];
    private static string $baseUrl = '';

    public static function init(string $baseUrl = '') {
        self::$baseUrl = $baseUrl;
    }

    public static function add(string $method, string $path, callable|array $handler) {
        self::$routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public static function get(string $path, callable|array $handler) {
        self::add('GET', $path, $handler);
    }

    public static function post(string $path, callable|array $handler) {
        self::add('POST', $path, $handler);
    }

    public static function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove base URL from path if it exists
        if (self::$baseUrl && strpos($path, self::$baseUrl) === 0) {
            $path = substr($path, strlen(self::$baseUrl));
        }

        foreach (self::$routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            $pattern = preg_replace('/\/{([^\/]+)}/', '/(?P<$1>[^/]+)', $route['path']);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, function ($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);

                if (is_array($route['handler'])) {
                    [$controller, $method] = $route['handler'];
                    $controller = new $controller();
                    call_user_func_array([$controller, $method], $params);
                } else {
                    call_user_func_array($route['handler'], $params);
                }
                return;
            }
        }

        // No route found
        header("HTTP/1.0 404 Not Found");
        require_once __DIR__ . '/../views/404.php';
    }
} 