<?php
declare(strict_types=1);

use App\Controllers\AddShampooController;
use App\Controllers\ShampooController;
use App\Controllers\ShampoosController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();

    //demo code - two ways of linking urls to functionality, either via anon function or linking to a controller

    $app->get('/', function ($request, $response, $args) use ($container) {
        $renderer = $container->get(PhpRenderer::class);
        return $renderer->render($response, "index.php", $args);
    });

    $app->get('/shampoos', ShampoosController::class);
    $app->get('/shampoos/add', AddShampooController::class);
    $app->post('/shampoos/add', AddShampooController::class);
    $app->get('/shampoos/{id}', ShampooController::class);
};
