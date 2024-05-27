<?php 

namespace App\Router;

use Router;

class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action,
    ){
    }

    public static function get(string $uri, $action): static
    {
        return new static('/api' . $uri, 'GET', $action);
    }

    public static function post(string $uri, $action)
    {
        return new static('/api' . $uri, 'POST', $action);
    }

    public static  function delete(string $uri, $action)
    {
        return new static('/api' . $uri, 'DELETE', $action);
    }

    public static function put(string $uri, $action)
    {
        return new static('/api' . $uri, 'PUT', $action);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getAction()
    {
        return $this->action;
    }
}