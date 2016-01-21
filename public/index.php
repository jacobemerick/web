<?php

$startTime = microtime(true);
ini_set('display_errors', 0);

require_once __DIR__ . '/../bootstrap.php';


// adds profiler
$di->set('console', $di->lazyNew('Particletree\Pqp\Console'));
$di->set('profiler', $di->lazyNew(
    'Particletree\Pqp\PhpQuickProfiler',
    array('startTime' => $startTime),
    array('setConsole' => $di->lazyGet('console'))
));
$di->get('logger')->pushHandler(
    new Jacobemerick\MonologPqp\PqpHandler($di->get('console'))
);


// sets up shutdown function to display profiler
register_shutdown_function(function () use ($container, $di) {
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

    $profiler = $di->get('profiler');
    $profiler->setProfiledQueries($dbProfiles);
    $profiler->setDisplay(new Particletree\Pqp\Display());
    $profiler->display($container['db_connection_locator']->getRead());
});
