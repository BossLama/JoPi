# The JoPI Framework 
## Getting started

Create a index.php file in the public folder
```php
<?php

declare(strict_types=1);
error_reporting(E_ALL);
header('Content-Type: application/json');

use JoPi\App\Logger;
use JoPi\App\App;

require_once __DIR__ . '/../vendor/autoload.php';

// Handle errors and exceptions
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

// Handle exceptions
set_exception_handler(function ($e) {
    Logger::logError("'" . $e->getMessage() . "' in " . $e->getFile() . " on line " . $e->getLine());
    $reponse = array();
    $reponse['status'] = 500;
    $reponse['message'] = 'An error occured';
    $response['error'] = $e->getMessage();
    echo json_encode($reponse);
});

// =================================== A P P L I C A T I O N ===================================

Logger::clearLogFile();
Logger::setLogLevel(4);

$app = new App('/projects/JoPi/public/');

$app->setRouteHandler("/", new \Custom\Routes\RootRoute($app));

$app->run();
?>
```

