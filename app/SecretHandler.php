<?php

namespace JoPi\App;
class SecretHandler
{

    private string $secret_folder;

    public function __construct()
    {
        $this->secret_folder = dirname(__DIR__) . "/secrets/";
    }

    // Returns a secret by its name
    public function getSecret(string $secret_name) : string
    {
        $secret_file = $this->secret_folder . $secret_name . ".key";
        if(file_exists($secret_file))
        {
            return file_get_contents($secret_file);
        }
        return "";
    }

}

?>