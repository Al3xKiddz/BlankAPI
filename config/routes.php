<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    $app->post('/users', \App\Action\UserCreateAction::class);

    // Documentation de l'api
    $app->get('/docs/v1', \App\Action\Docs\SwaggerUiAction::class);

    $app->post('/create', \App\Action\LivreCreateAction::class);

    $app->get('/read', \App\Action\LivreReadAction::class);

    $app->patch('/update', \App\Action\LivreUpdateAction::class);

    $app->delete('/delete', \App\Action\LivreDeleteAction::class);
};

