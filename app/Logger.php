<?php

namespace JoPi\App;
class Logger
{

    private static int $logLevel = 0;       /**  0 = no logging, 
                                            *    1 = errors only, 
                                            *    2 = errors and warnings, 
                                            *    3 = errors, warnings and info, 
                                            *    4 = errors, warnings, info and debug **/

    // Returns the log file
    private static function getLogFile() : string
    {
        return dirname(__DIR__) . '/logs/system.log';
    }

    // Clears the log file
    public static function clearLogFile()
    {
        file_put_contents(self::getLogFile(), '');
    }

    // Sets the log level
    public static function setLogLevel(int $logLevel)
    {
        self::$logLevel = $logLevel;
        self::logDebug('Log level set to ' . $logLevel);
    }

    // Returns the prefix of the log message
    private static function getPrefix(string $level) : string
    {
        return '[' . date('d-m-Y H:i:s') . '][' . $level . ']';
    }

    // Logs a error message
    public static function logError(string $message)
    {
        if(self::$logLevel >= 1)
        {
            $prefix = self::getPrefix('ERROR');
            file_put_contents(self::getLogFile(), $prefix . ' ' . $message . PHP_EOL, FILE_APPEND);
        }
    }

    // Logs a warning message
    public static function logWarning(string $message)
    {
        if(self::$logLevel >= 2)
        {
            $prefix = self::getPrefix('WARNING');
            file_put_contents(self::getLogFile(), $prefix . ' ' . $message . PHP_EOL, FILE_APPEND);
        }
    }

    // Logs a info message
    public static function logInfo(string $message)
    {
        if(self::$logLevel >= 3)
        {
            $prefix = self::getPrefix('INFO');
            file_put_contents(self::getLogFile(), $prefix . ' ' . $message . PHP_EOL, FILE_APPEND);
        }
    }

    // Logs a debug message
    public static function logDebug(string $message)
    {
        if(self::$logLevel >= 4)
        {
            $prefix = self::getPrefix('DEBUG');
            file_put_contents(self::getLogFile(), $prefix . ' ' . $message . PHP_EOL, FILE_APPEND);
        }
    }

}

?>