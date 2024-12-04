<?php

namespace Custom\Routes;

use JoPi\App\Authenticator;
use JoPi\App\Entities\JWT;
use JoPi\App\Route;
use JoPi\App\SecretHandler;

class ExampleRoute extends Route
{

    public function handleGet() : array
    {
        $response = array();
        $response['status'] = 200;
        $response['message'] = 'This is the example endpoint';
        $response['variables'] = $this->getVariables();
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