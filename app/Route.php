<?php

namespace JoPi\App;
abstract class Route
{

    private App $app;
    private array $variables;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    // Handles the request and redirect it to the correct method
    public function handleRequest(array $variables = []) : array
    {
        $this->variables = $variables;
        switch($this->app->getMethod())
        {
            case 'GET':
                return $this->handleGet();
            case 'POST':
                return $this->handlePost();
            case 'PUT':
                return $this->handlePut();
            case 'DELETE':
                return $this->handleDelete();
            default:
                return $this->METHOD_NOT_ALLOWED();
        }
    }

    abstract public function handleGet() : array;
    abstract public function handlePost() : array;
    abstract public function handlePut() : array;
    abstract public function handleDelete() : array;

    // Returns a 405 response
    public function METHOD_NOT_ALLOWED() : array
    {
        $response = array();
        $response['status'] = 405;
        $response['message'] = 'Method not allowed';
        return $response;
    }

    // Returns the app
    public function getApp() : App
    {
        return $this->app;
    }

    // Returns the variables
    public function getVariables() : array
    {
        return $this->variables;
    }
}

?>