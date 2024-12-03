<?php
namespace JoPi\App\Entities;
use \JoPi\App\Config;

class JWT
{

    private array       $payload;
    private ?string     $signature;

    public function __construct(int $expiresAfterSeconds = 3600, string $userID = "",  ?string $signature = null)
    {
        $this->payload = [
            'exp' => time() + $expiresAfterSeconds,
            'uid' => $userID
        ];
        $this->signature = $signature;
    }

    // Create a signature for the token
    public function sign()
    {
        $tokenConfig        = Config::getTokenConf();
        $tokenSecret        = $tokenConfig['secret'];

        $payload            = json_encode($this->payload);
        $signature          = hash_hmac('sha256', $payload, $tokenSecret);

        $this->signature    = $signature;
    }

    // Get the token as string
    public function toString() : string
    {
        if($this->signature == null) $this->sign();
        $payload            = base64_encode(json_encode($this->payload));
        $signature          = $this->signature;

        return $payload . '.' . $signature;
    }

    // Create from string
    public static function fromString(string $token) : JWT
    {
        if(!self::verfify($token)) return null;
        $tokenParts         = explode('.', $token);
        $payload            = json_decode(base64_decode($tokenParts[0]), true);
        $signature          = $tokenParts[1];

        return new JWT($payload["exp"], $payload["uid"], $signature);
    }

    // Verify the signature, expire time and syntax of the token
    public static function verfify(string $token) : bool
    {
        $tokenConfig        = Config::getTokenConf();
        $tokenSecret        = $tokenConfig['secret'];

        $tokenParts         = explode('.', $token);
        if (count($tokenParts) !== 2) {
            return false;
        }

        $payload            = base64_decode($tokenParts[0]);
        $signature          = $tokenParts[1];

        $expectedSignature  = hash_hmac('sha256', $payload, $tokenSecret);
        if ($signature !== $expectedSignature) {
            return false;
        }

        $payload            = json_decode($payload, true);
        if (!isset($payload['exp'])) {
            return false;
        }

        $now                = time();
        if ($payload['exp'] < $now) {
            return false;
        }

        return true;
    }

}

?>