<?php

namespace Custom\Routes;
use JoPi\App\Route;

class RootRoute extends Route
{

    public function handleGet() : array
    {
        $reponse = array();
        $reponse['status'] = 200;
        $reponse['message'] = 'Welcome to the JoPi-API';
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