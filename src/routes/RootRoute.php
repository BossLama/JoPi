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
        $jwt = JWT::getInstance(3600, ['user' => 'admin']);
        Authenticator::setSecureCookie('auth_token', $jwt->toString(), 3600);

        $authenticated = Authenticator::authenticate();

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