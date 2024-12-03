<?php

namespace JoPi\App;

class App
{
    private string $root_path;
    private array  $routes;

    public function __construct(string $root_path = "public/")
    {
        $this->root_path = $root_path;
        $this->routes = [];
    }

    public function setRouteHandler(string $routePattern, Route $routeHandler)
    {
        $regexPattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $routePattern);
        $this->routes[$regexPattern] = $routeHandler;
    }

    public function getRequestedRoute(): string
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace($this->root_path, '', $uri);
        $uri = explode('?', $uri)[0];
        return "/" . trim($uri, "/");
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody(): array
    {
        $body = file_get_contents('php://input');
        return json_decode($body, true) ?? [];
    }

    public function getArguments(): array
    {
        return $_GET;
    }

    public function run()
    {
        Logger::logDebug("App running with root at '" . $this->root_path . "'");
        $requestedRoute = $this->getRequestedRoute();
        $response = null;

        foreach ($this->routes as $routePattern => $routeHandler) {
            if (preg_match("#^" . $routePattern . "$#", $requestedRoute, $matches)) {
                Logger::logDebug("Calling route handler for route '" . $requestedRoute . "'");
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                $response = $routeHandler->handleRequest($params);
                echo json_encode($response);
                return;
            }
        }

        Logger::logWarning("No route handler found for '" . $requestedRoute . "'");
        $response = [
            'status' => 404,
            'message' => 'Route not found'
        ];
        echo json_encode($response);
    }
}


?>