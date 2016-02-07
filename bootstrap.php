<?php

require_once __DIR__ . '/vendor/autoload.php';

$container = new Pimple\Container();


// load the config for the application
$config_path = __DIR__ . '/config.json';

$handle = @fopen($config_path, 'r');
if ($handle === false) {
    throw new RuntimeException("Could not load config");
}
$config = fread($handle, filesize($config_path));
fclose($handle);

$config = json_decode($config);
$last_json_error = json_last_error();
if ($last_json_error !== JSON_ERROR_NONE) {
    throw new RuntimeException("Could not parse config - JSON error detected");
}
$container['config'] = $config;


// timezones are fun
date_default_timezone_set('America/Phoenix'); // todo - belongs in configuration
$container['default_timezone'] = function ($c) {
    return new DateTimeZone('America/Phoenix');
};


// configure the db connections holder
$db_connections = new Aura\Sql\ConnectionLocator();
$db_connections->setDefault(function () use ($config) {
    $connection = $config->database->slave;
    return new Aura\Sql\ExtendedPdo(
        "mysql:host={$connection->host}",
        $connection->user,
        $connection->password
    );
});
$db_connections->setWrite('master', function () use ($config) {
    $connection = $config->database->master;
    return new Aura\Sql\ExtendedPdo(
        "mysql:host={$connection->host}",
        $connection->user,
        $connection->password
    );
});
$db_connections->setRead('slave', function () use ($config) {
    $connection = $config->database->slave;
    $pdo = new Aura\Sql\ExtendedPdo(
        "mysql:host={$connection->host}",
        $connection->user,
        $connection->password
    );

    $profiler = new Aura\Sql\Profiler();
    $profiler->setActive(true);
    $pdo->setProfiler($profiler);

    return $pdo;
});
$container['db_connection_locator'] = $db_connections;


// setup mail handler
$container['mail'] = $container->factory(function ($c) {
    return (new Jacobemerick\Archangel\Archangel())->setLogger($c['logger']);
});


// setup the logger
$container['setup_logger'] = $container->protect(function ($name) use ($container) {
    $logger = new Monolog\Logger($name);

    $logPath = __DIR__ . "/../logs/{$name}.log";
    $streamHandler = new Monolog\Handler\StreamHandler($logPath, Monolog\Logger::INFO);
    $streamHandler->setFormatter(
        new Monolog\Formatter\LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n")
    );
    $logger->pushHandler($streamHandler);

    Monolog\ErrorHandler::register($logger);
    $container['logger'] = $logger;
});


