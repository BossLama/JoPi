<?php

namespace JoPi\App;
class App
{

    private string $root_path;
    private array  $routes;

    public function __construct(string $root_path = "public/")
    {
        $this->root_path = $root_path;
        $this->routes = array();
    }

    public function setRouteHandler(string $route, Route $routeHandler)
    {
        $this->routes[$route] = $routeHandler;
    }

    public function getRequestedRoute() : string
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace($this->root_path, '', $uri);
        $uri = explode('?', $uri)[0];
        $uri = explode('/', $uri)[0];
        return "/" . $uri;
    }

    public function getMethod() : string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody() : array
    {
        $body = file_get_contents('php://input');
        return json_decode($body, true);
    }

    public function getArguments() : array
    {
        return $_GET;
    }

    public function run()
    {
        Logger::logDebug("App running with root at '" . $this->root_path . "'");
        $reponse = null;
        $requestedRoute = $this->getRequestedRoute();

        if(isset($this->routes[$requestedRoute]))
        {
            Logger::logDebug("Calling route handler for route '" . $requestedRoute. "'");
            $routeHandler = $this->routes[$requestedRoute];
            $reponse = $routeHandler->handleRequest();
        }
        else
        {
            Logger::logWarning("No route handler found for '" . $requestedRoute . "'");
            $reponse = array();
            $reponse['status'] = 404;
            $reponse['message'] = 'Route not found';
        }

        echo json_encode($reponse);
    }
}

?>