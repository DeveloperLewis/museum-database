<?php

namespace classes\server;

class Router
{

    private array $handlers = [];
    private object $notFound;
    private const get = 'GET';
    private const post = 'POST';



    public function get($path, $handler): void
    {
        $this->createHandler(self::get, $path, $handler);
    }

    public function post($path, $handler): void
    {
        $this->createHandler(self::post, $path, $handler);
    }

    public function notFound($handler): void
    {
        $this->notFound = $handler;
    }

    private function createHandler($method, $path, $handler): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function run(): void
    {
        //Получает ссылку откуда пришел запрос
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];

        $method = $_SERVER['REQUEST_METHOD'];
        $callback = null;

        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $method === $handler['method']) {
                $callback = $handler['handler'];
            }
        }

        if (!$callback) {
            header("HTTP/1.0 404 Not Found");
            if (!empty($this->notFound)) {
                $callback = $this->notFound;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);

    }

}