<?php

namespace JoPi\App;

use JoPi\App\Entities\JWT;

class Authenticator
{

    // Authenticate a user
    public static function authenticate(bool $renew = false) : bool
    {
        $auth_token = $_COOKIE['auth_token'] ?? "";
        if(!JWT::validate($auth_token)) return false;

        $jwt = JWT::fromString($auth_token);
        if($jwt === null) return false;

        if($renew)
        {
            $jwt = JWT::getInstance(3600, $jwt->getPayload()['data']);
            self::setSecureCookie('auth_token', $jwt->toString(), 3600);
        }
        return true;
    }

    // Set a secure cookie
    public static function setSecureCookie(string $name, string $value, int $expires) : void
    {
        $options = [
            'expires' => time() + 3600,
            'path' => '/',
            'domain' => '',
            'secure' => false,  # TODO: Change to true in production
            'httponly' => true,
            'samesite' => 'Strict'
        ];
        setcookie($name, $value, $options);
    }

}
?>