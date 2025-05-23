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

    // Create a new secret
    public function createSecret(string $secret_name, string $secret) : bool
    {
        $secret_file = $this->secret_folder . $secret_name . ".key";
        return file_put_contents($secret_file, $secret) !== false;
    }

    // Returns a new instance
    public static function getInstance() : SecretHandler
    {
        return new SecretHandler();
    }
}

?>