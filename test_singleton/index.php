<?php
class Singleton
{

    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }
}

class Logger extends Singleton
{
    private $fileHandle;

    protected function __construct()
    {
        $this->fileHandle = new \mysqli("localhost", "mysql", "mysql", "jumpers");
        file_put_contents('log2.txt', date("Y-m-d H:i:s") . " создан экземпляр db\n", FILE_APPEND);
    }

    public function writeLog(string $message): void
    {
        file_put_contents('log.txt', date("Y-m-d H:i:s") . " {$message}\n", FILE_APPEND);
    }

    public static function log(string $message): void
    {
        $logger = static::getInstance();
        $logger->writeLog($message);
    }
}

Logger::log("Started!");

// Сравниваем значения одиночки-Логгера.
$l1 = Logger::getInstance();
$l2 = Logger::getInstance();
if ($l1 === $l2) {
    Logger::log("Logger has a single instance.");
} else {
    Logger::log("Loggers are different.");
}
Logger::log("Logger has a single instance.");
Logger::log("Logger has a single instance.");
Logger::log("Logger has a single instance.");
Logger::log("Logger has a single instance.");