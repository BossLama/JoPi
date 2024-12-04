<?php

namespace JoPi\App;
class Config
{

    // Token configuration
    public static function getTokenConf()
    {
        $secretHandler = new SecretHandler();

        return [
            'secret' => $secretHandler->getSecret('jwt_secret')
        ];
    }
    
    // Database configuration
    public static function getDatabaseConf()
    {
        $secretHandler = new SecretHandler();
        $json = $secretHandler->getSecret('database_conf');
        return json_decode($json, true);
    }
}

?>