<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Models\ShampooModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class ShampooController
{
    private ShampooModel $model;
    private PhpRenderer $renderer;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(ShampooModel $model, PhpRenderer $renderer)
    {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $shampoo = $this->model->getShampoo(intval($args['id']));
        return $this->renderer->render($response, 'shampoo.phtml', ['shampoo'=>$shampoo]);
    }
}