<?php
namespace JoPi\App\Entities;
use \JoPi\App\Config;

class JWT
{

    private array       $header;
    private array       $payload;
    private string      $signature;

    public function __construct(array $header, array $payload, string $signature)
    {
        $this->header = $header;
        $this->payload = $payload;
        $this->signature = $signature;
    }

    // Returns the JWT as a string
    public function toString() : string
    {
        return base64_encode(json_encode($this->header)) . '.' . base64_encode(json_encode($this->payload)) . '.' . $this->signature;
    }

    // Getters
    public function getHeader() : array { return $this->header; }
    public function getPayload() : array { return $this->payload; }
    public function getSignature() : string { return $this->signature; }

    // Returns a JWT object 
    public static function getInstance(int $expiresAfter = 3600, array $data = [])
    {
        $header = ['alg' => 'HS256', 'typ' => 'JWT'];
        $payload = ['exp' => time() + $expiresAfter, 'data' => $data];

        $headerBase64 = base64_encode(json_encode($header));
        $payloadBase64 = base64_encode(json_encode($payload));

        $secret = Config::getTokenConf()['secret'];
        $signature = hash_hmac('sha256', $headerBase64 . '.' . $payloadBase64, $secret);

        return new JWT($header, $payload, $signature);
    }

    // Returns a JWT object from string
    public static function fromString(string $jwt) : ?JWT
    {
        if(!self::validate($jwt)) return null;
        $parts = explode('.', $jwt);
        $header = json_decode(base64_decode($parts[0]), true);
        $payload = json_decode(base64_decode($parts[1]), true);
        $signature = $parts[2];

        return new JWT($header, $payload, $signature);
    }

    // Validates a JWT string
    public static function validate(string $jwt) : bool
    {
        $parts = explode('.', $jwt);
        if(count($parts) !== 3)
        {
            return false;
        }

        $header = json_decode(base64_decode($parts[0]), true);
        $payload = json_decode(base64_decode($parts[1]), true);
        $signature = $parts[2];

        $secret = Config::getTokenConf()['secret'];
        $expectedSignature = hash_hmac('sha256', $parts[0] . '.' . $parts[1], $secret);

        if($header['alg'] !== 'HS256') return false;
        if($signature !== $expectedSignature) return false;
        if($payload['exp'] < time()) return false;
        
        return true;
    }
}

?>