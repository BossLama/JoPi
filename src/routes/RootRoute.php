<?php

namespace Custom\Routes;
use JoPi\App\Route;
use JoPi\App\SecretHandler;

class RootRoute extends Route
{

    public function handleGet() : array
    {
        $response = array();
        $response['status'] = 200;
        $response['message'] = 'Welcome to the JoPi-API';
        return $response;
    }

    public function handlePost() : array
    {
        return $this->METHOD_NOT_ALLOWED();
    }

    public function handlePut() : array
    {
        return $this->METHOD_NOT_ALLOWED();
    }

    public function handleDelete() : array
    {
        return $this->METHOD_NOT_ALLOWED();
    }

}

?>