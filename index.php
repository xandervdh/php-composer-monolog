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
$console = new Logger('console');

// Now add some handlers

//$logger->pushHandler(new NativeMailerHandler('xander-v.d.h@hotmail.com', 'logger', 'xander'));

// You can now use your logger
switch ($type){
    case 'INFO':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/info.log', Logger::INFO));
        $logger->info($message);
        $console->pushHandler(new BrowserConsoleHandler(Logger::INFO, true));
        $console->info($message);
        break;
    case 'DEBUG':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/info.log', Logger::DEBUG));
        $logger->debug($message);
        break;
    case 'NOTICE':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/info.log', Logger::NOTICE));
        $logger->notice($message);
        break;
    case 'WARNING':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/warning.log', Logger::WARNING));
        $logger->warning($message);
        break;
    case 'ALERT':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/warning.log', Logger::ALERT));
        $logger->alert($message);
        break;
    case 'ERROR':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/warning.log', Logger::ERROR));
        $logger->error($message);
        break;
    case 'CRITICAL':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/warning.log', Logger::CRITICAL));
        $logger->critical($message);
        break;
    case 'EMERGENCY':
        $logger->pushHandler(new StreamHandler(__DIR__.'/log/emergency.log', Logger::EMERGENCY));
        $logger->emergency($message);
        break;
}


require_once 'buttons.html';