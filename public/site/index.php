<?php

date_default_timezone_set('America/Chicago');

require_once __DIR__ . '/../../bootstrap.php';

// sets up loggers
$logger = new Monolog\Logger('site');

$streamHandler = new Monolog\Handler\StreamHandler(__DIR__ . '/../../logs/site.log', Monolog\Logger::INFO);
$streamHandler->setFormatter(
    new Monolog\Formatter\LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n")
);
$logger->pushHandler($streamHandler);

$pqpHandler = new Jacobemerick\MonologPqp\PqpHandler($container['console']);
$logger->pushHandler($pqpHandler);

Monolog\ErrorHandler::register($logger);

$container['logger'] = $logger;
$container['logger']->addDebug('Bootstrapping is complete - moving onto routing');
$container['console']->logMemory(null, 'Bootstrapping done');

// route
Loader::loadInstance('router', 'Router');

$container['logger']->addDebug('Routing is complete - moving onto shutdown');
$container['console']->logMemory(null, 'Routing is done');

// shutdown - note, this should be in a shutdown function
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
