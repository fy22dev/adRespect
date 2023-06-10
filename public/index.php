<?php
declare(strict_types=1);

require_once(__DIR__ . '/../vendor/autoload.php');

use FastRoute\RouteCollector;

$container = require __DIR__ . '/../app/bootstrap.php';

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['Inter\Controller\HomeController', 'list']);
    $r->addRoute('POST', '/refresh/', ['Inter\Controller\RateController', 'refresh']);
    $r->addRoute('GET', '/convert/', ['Inter\Controller\ConvertController', 'convert']);
    $r->addRoute('POST', '/convert/', ['Inter\Controller\ConvertController', 'convert']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;

    case FastRoute\Dispatcher::FOUND:
        try {
            $controller = $route[1];
            $parameters = $route[2];

            $container->call($controller, $parameters);
        } catch (\Throwable $th) {
            echo $th->getMessage();
            die;
        }
        break;
}