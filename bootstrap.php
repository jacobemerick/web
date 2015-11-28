<?php

include_once 'vendor/autoload.php';

// load the config for the application
$configuration_path = 'config.json';

$handle = @fopen($configuration_path, 'r');
if ($handle === false) {
    throw new RuntimeException("Could not load configuration");
}
$configuration = fread($handle, filesize($configuration_path));
fclose($handle);

$configuration = json_decode($configuration);
$last_json_error = json_last_error();
if ($last_json_error !== JSON_ERROR_NONE) {
    throw new RuntimeException("Could not parse configuration - JSON error detected");
}

// configure the db connections holder
$db_connections = new Aura\Sql\ConnectionLocator();
$db_connections->setDefault(function () use ($configuration) {
    $connection = $configuration->database->slave;
    return new Aura\Sql\ExtendedPdo(
        "mysql:host={$connection->host}",
        $connection->user,
        $connection->password
    );
});
$db_connections->setWrite('master', function () use ($configuration) {
    $connection = $configuration->database->master;
    return new Aura\Sql\ExtendedPdo(
        "mysql:host={$connection->host}",
        $connection->user,
        $connection->password
    );
});
$db_connections->setRead('slave', function () use ($configuration) {
    $connection = $configuration->database->slave;
    return new Aura\Sql\ExtendedPdo(
        "mysql:host={$connection->host}",
        $connection->user,
        $connection->password
    );
});

// setup the service locator
$container = new Pimple\Container();
$container['db_connection_locator'] = $db_connections;

