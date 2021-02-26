<?php

use App\Controller\GreetingController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

//Ajouter nos route
$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'world',
    '_controller' => [new GreetingController(), 'hello']
]));
$routes->add('bye', new Route('/bye', [
    '_controller' => [new GreetingController(), 'bye']
]));
$routes->add('about', new Route('/about', [
    '_controller' => [new GreetingController(), 'about']
]));

return $routes;