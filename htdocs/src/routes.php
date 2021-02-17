<?php

//Créer une route collection qui va contenir toutes les routes de notre application
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

//Ajouter nos route
$routes->add('hello', new Route('/hello/{name}', ['name' => 'world']));
$routes->add('bye', new Route('/bye'));
$routes->add('about', new Route('/about'));

return $routes;