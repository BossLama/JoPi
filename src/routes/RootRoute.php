<?php

namespace Custom\Routes;
use JoPi\App\Route;

class RootRoute extends Route
{

    public function handleGet() : array
    {
        $jwt = new \JoPi\App\Entities\JWT(3600, "my-user-id");
        $jwt->sign();
        $token = $jwt->toString();

        $reponse = array();
        $reponse['status'] = 200;
        $reponse['message'] = 'Welcome to the API';
        $reponse['token'] = $token;
        return $reponse;
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