<?php

namespace App\Router;

use App\Router\Route;

class Router
{
    public function __construct()
    {
        $this->initRoutes();
    }
    
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function dispatch(string $uri, string $method)
    {
        $route = $this->findRoute($uri, $method);
        $this->notFoundRoute($route);

        if (is_array($route->getAction())){
            [$controller, $action] = $route->getAction();
            $controller = new $controller;
            echo json_encode(call_user_func([$controller, $action]));
        }
    }

    public function notFoundRoute($route)
    {
        if (!$route) {
            http_response_code(404);
            echo json_encode(['message' => 'Роут не найден!']);
            die();
        }
    }
    
    public function findRoute(string $uri, string $method)
    {
        $parts = explode('?', $uri);
        $baseUri = $parts[0];

        if (! isset($this->routes[$method][$baseUri])) {
            return false;
        }

        return $this->routes[$method][$baseUri];
    }

    public function initRoutes()
    {
        $routes = $this->getRoutes();

        foreach($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return require_once(__DIR__.'/../../routes.php');
    }
}