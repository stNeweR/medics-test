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
        // var_dump(new static($uri, 'GET', $action));
        return new static('/api' . $uri, 'GET', $action);
    }

    public static function post(string $uri, $action)
    {
        return new static('/api' . $uri, 'POST', $action);
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