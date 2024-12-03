# The JoPI Framework 
## Getting started

Erstelle eine index.php im /public/ Ordner mit folgendem Code:
```php
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

Logger::clearLogFile();
Logger::setLogLevel(4);

// =================================== A P P L I C A T I O N ===================================
```

Ändere das Logging-Verhalten entsprechend deiner Wünsche. Der Befehl ```Logger::clearLogFile()``` 
löscht den Log bei jeder neuen Anfrage. Dies erleichtert das Testen.

Über ```Logger::setLogLevel(4)``` kann ausgewählt werden, welche Logs erfasst werden.
- 0     |       Keine Logs
- 1     |       Fehler werden geloggt
- 2     |       Fehler & Warnungen werden geloggt
- 3     |       Fehler, Warnungen & Infos werden geloggt
- 4     |       Fehler, Warnungen, Infos & Debugs werden geloggt


