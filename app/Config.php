<?php

namespace JoPi\App;
class Config
{

    public static function getTokenConf()
    {
        $secretHandler = new SecretHandler();

        return [
            'secret' => $secretHandler->getSecret('jwt_secret')
        ];
    }
    
}

?>