<?php

$namespace = 'site';
require_once __DIR__ . '/../index.php';

// route
$container['console']->logMemory(null, 'Bootstrapping is done');

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'HomeController');
    $r->addRoute('GET', '/terms/', 'TermsController');
    $r->addRoute('GET', '/change-log/', 'ChangelogController');
    $r->addRoute(['GET', 'POST'], '/contact/', 'ContactController');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
$status = reset($routeInfo);

switch ($status) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $container['logger']->debug('Route not found - 404');
        Loader::loadNew('controller', '/Error404Controller')->activate();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // todo - return allowed routes in header
        $container['logger']->debug('Unallowed method - 405');
        Loader::loadNew('controller', '/Error404Controller')->activate();
        break;
    case FastRoute\Dispatcher::FOUND:
        $container['logger']->debug('found!');
        Loader::loadNew('controller', "{$namespace}/{$routeInfo[1]}")->activate();
        break;
}

$container['console']->logMemory(null, 'Routing is done');
