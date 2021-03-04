<?php

use App\Controller\GreetingController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

//Ajouter nos route
$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'world',
    '_controller' => 'App\Controller\GreetingController::hello'
]));
$routes->add('bye', new Route('/bye', [
    '_controller' => 'App\Controller\GreetingController::bye'
]));
$routes->add('about', new Route('/about', [
    '_controller' => 'App\Controller\GreetingController::about'
]));

return $routes;