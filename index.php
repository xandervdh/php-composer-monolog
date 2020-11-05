<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\NativeMailerHandler;
$type = $_GET['type'];
$message = $_GET['message'];
// Create the logger
$logger = new Logger('my_logger');

// Now add some handlers
$logger->pushHandler(new BrowserConsoleHandler);
//$logger->pushHandler(new NativeMailerHandler('xander-v.d.h@hotmail.com', 'logger', 'xander'));

// You can now use your logger
switch ($type){
    case 'INFO' || 'DEBUG' || 'NOTICE':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/info.log', Logger::INFO));
        //$logger->info($message);
        break;
    case 'WARNING' || 'ERROR' || 'CRITICAL' || 'ALERT':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/warning.log', Logger::WARNING));
        //$logger->warning($message);
        break;
    case 'EMERGENCY':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/emergency.log', Logger::EMERGENCY));
        //$logger->emergency($message);
        break;
}
$logger->$type($message);

require_once 'buttons.html';