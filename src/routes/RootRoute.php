<?php

namespace Custom\Routes;

use JoPi\App\Authenticator;
use JoPi\App\Entities\JWT;
use JoPi\App\Route;
use JoPi\App\SecretHandler;

class RootRoute extends Route
{

    public function handleGet() : array
    {
        $authenticated = Authenticator::authenticate(true);

        $response = array();
        $response['status'] = 200;
        $response['message'] = 'Welcome to the JoPi-API';
        $response['authenticated'] = $authenticated;
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