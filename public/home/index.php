<?php

$namespace = 'home';
require_once __DIR__ . '/../index.php';

// route
$container['console']->logMemory(null, 'Bootstrapping is done');
Loader::loadInstance('router', 'Router');
$container['console']->logMemory(null, 'Routing is done');
