<?php

$namespace = 'site';
require_once __DIR__ . '/../index.php';


// configure logger handler
$logPath = __DIR__ . "/../logs/site.log";
$streamHandler = new Monolog\Handler\StreamHandler($logPath, Monolog\Logger::INFO);
$streamHandler->setFormatter(
    new Monolog\Formatter\LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n")
);
$di->get('logger')->pushHandler($streamHandler);


// route
$di->get('console')->logMemory(null, 'Bootstrapping is done');

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
        $di->get('logger')->debug('Route not found - 404');
        Loader::loadNew('controller', '/Error404Controller')->activate();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // todo - return allowed routes in header
        $di->get('logger')->debug('Unallowed method - 405');
        Loader::loadNew('controller', '/Error404Controller')->activate();
        break;
    case FastRoute\Dispatcher::FOUND:
        $di->get('logger')->debug('found!');
        Loader::loadNew('controller', "{$namespace}/{$routeInfo[1]}")->activate();
        break;
}

$di->get('console')->logMemory(null, 'Routing is done');
