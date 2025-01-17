<?php

$router = $di->getRouter();

// Define your routes here


$router->add(
    '/auth/register',
    [
        'controller' => 'register',
        'action'     => 'register',
    ]
);

$router->add(
    '/auth/login',
    [
        'controller' => 'login',
        'action'     => 'login',
    ]
);


$router->handle($_SERVER['REQUEST_URI']);
