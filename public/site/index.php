<?php

date_default_timezone_set('America/Chicago');

require_once __DIR__ . '/../../bootstrap.php';

// sets up specific logger
use Jacobemerick\MonologPqp\PqpHandler;
use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$streamHandler = new StreamHandler(
    __DIR__ . '/../../logs/site.log',
    Logger::DEBUG
);
$streamHandler->setFormatter(
    new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n")
);

$logger = new Logger('web');
$logger->pushHandler($streamHandler);

ErrorHandler::register($logger);

$container['logger'] = $logger;
$container['logger']->addInfo('Bootstrapping is complete - moving onto routing');

// old setup
Loader::loadInstance('utility', 'Debugger');

set_error_handler(array('Debugger', 'internal_error'));
register_shutdown_function(array('Debugger', 'shutdown'));

$logger->pushHandler(new PqpHandler(Debugger::instance()->console));
$container['logger']->addInfo('Debugger set up, about to start routing');

Loader::loadInstance('router', 'Router');
