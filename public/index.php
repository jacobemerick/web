<?php

$startTime = microtime(true);
ini_set('display_errors', 0);

require_once __DIR__ . '/../bootstrap.php';


// adds profiler
$console = new Particletree\Pqp\Console();
$profiler = new Particletree\Pqp\PhpQuickProfiler($startTime);
$profiler->setConsole($console);
$container['console'] = $console;
$container['profiler'] = $profiler;


// sets up logger, modifes with profiler handler
$pqpHandler = new Jacobemerick\MonologPqp\PqpHandler($container['console']);
$container['setup_logger']($namespace);
$container['logger']->pushHandler($pqpHandler);


// sets up shutdown function to display profiler
register_shutdown_function(function () use ($container) {
    if (
        !isset($_COOKIE['debugger']) ||
        $_COOKIE['debugger'] != 'display'
    ) {
        return;
    }

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
});
