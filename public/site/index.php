<?php

date_default_timezone_set('America/Chicago');

require_once __DIR__ . '/../../bootstrap.php';

// sets up specific logger
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$formatter = new LineFormatter('[%datetime%] %channel%.%level_name%: %message%');

$handler = new StreamHandler(
    __DIR__ . '/../../logs/site.log',
    Logger::DEBUG
);
$handler->setFormatter($formatter);

$logger = new Logger('web');
$logger->pushHandler($handler);

$container['logger'] = $logger;
$container['logger']->addInfo('Bootstrapping is complete - moving onto routing');

// old setup
Loader::loadInstance('utility', 'Debugger');

set_error_handler(array('Debugger', 'internal_error'));
register_shutdown_function(array('Debugger', 'shutdown'));

Loader::loadInstance('router', 'Router');
