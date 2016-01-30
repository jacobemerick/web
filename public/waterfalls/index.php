<?php

$namespace = 'waterfalls';
require_once __DIR__ . '/../index.php';

// route
Loader::loadInstance('router', 'Router');
$container['console']->logMemory(null, 'Routing is done');
