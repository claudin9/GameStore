<?php

class Router {
    private $routes = [];
    private $params = [];

    /**
     * Adiciona uma rota GET
     */
    public function get($route, $handler) {
        $this->addRoute('GET', $route, $handler);
    }

    /**
     * Adiciona uma rota POST
     */
    public function post($route, $handler) {
        $this->addRoute('POST', $route, $handler);
    }

    /**
     * Adiciona uma rota
     */
    private function addRoute($method, $route, $handler) {
        $route = trim($route, '/');
        $route = str_replace('/', '\/', $route);
        $route = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[^\/]+)', $route);
        $route = '/^' . $route . '$/';

        $this->routes[$method][$route] = $handler;
    }

    /**
     * Processa a rota atual
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $basePath = trim(parse_url(APP_URL, PHP_URL_PATH), '/');
        
        // Remove o basePath da URI se existir
        if ($basePath && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        $uri = trim($uri, '/');

        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            if (preg_match($route, $uri, $matches)) {
                // Remove os índices numéricos
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                // Separa o controller e o método
                list($controller, $method) = explode('@', $handler);
                
                // Adiciona o namespace
                $controller = "App\\Controllers\\{$controller}";
                
                // Cria a instância do controller
                $controller = new $controller();
                
                // Chama o método com os parâmetros
                return call_user_func_array([$controller, $method], $params);
            }
        }

        // Rota não encontrada
        http_response_code(404);
        require base_path('src/views/404.php');
    }
} 