<?php

date_default_timezone_set('America/Chicago');

require_once __DIR__ . '/../../bootstrap.php';

// sets up loggers
use Jacobemerick\MonologPqp\PqpHandler;
use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Particletree\Pqp\Console;
use Particletree\Pqp\PhpQuickProfiler;

$logger = new Logger('site');

$streamHandler = new StreamHandler(__DIR__ . '/../../logs/site.log', Logger::INFO);
$streamHandler->setFormatter(
    new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n")
);
$logger->pushHandler($streamHandler);

$pqpHandler = new PqpHandler($container['console']);
$logger->pushHandler($pqpHandler);

ErrorHandler::register($logger);

$container['logger'] = $logger;
$container['logger']->addDebug('Bootstrapping is complete - moving onto routing');
$container['console']->logMemory(null, 'Bootstrapping done');

Loader::loadInstance('router', 'Router');

$container['logger']->addDebug('Routing is complete - moving onto shutdown');
$container['console']->logMemory(null, 'Routing is done');

if ($_COOKIE['debugger'] == 'display') {
    $dbProfiles = $container['db_connection_locator']
        ->getRead()
        ->getProfiler()
        ->getProfiles();
    $dbProfiles = array_filter($dbProfiles, function ($profile) {
        return $profile['function'] == 'perform';
    });
    $dbProfiles = array_map(function ($profile) {
        return [
            'sql' => trim(preg_replace('/\s+/', ' ', $profile['statement'])),
            'parameters' => $profile['bind_values'],
            'time' => $profile['duration'],
        ];
    }, $dbProfiles);
    $container['profiler']->setProfiledQueries($dbProfiles);
    $container['profiler']->setDisplay(new Particletree\Pqp\Display());
    $container['profiler']->display($container['db_connection_locator']->getRead());
}
