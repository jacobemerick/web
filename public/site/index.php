<?php

$namespace = 'site';
require_once __DIR__ . '/../../bootstrap.php';

// route
Loader::loadInstance('router', 'Router');
$container['console']->logMemory(null, 'Routing is done');
