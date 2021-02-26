<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require __DIR__ . '/../vendor/autoload.php';

//createFromGlobals : Puise dans toutes les super global et crée un objet avec toutes ces informations
$request = Request::createFromGlobals();

//Return RouteCollection : a collection of all our application routes
$routes =  require __DIR__ . '/../src/routes.php';

//Verifier si l'adresse saisie correspond à une route
$context = new RequestContext();        //Info sur la requete qu'on vient de recevoir. Necessaire pour UrlMatcher
$context->fromRequest($request);        //Pioche les infos de la requete dont il a besoin

//Class pour verifier adresse
$urlMatcher = new UrlMatcher($routes, $context);        //Class qui verifie si une adresse correspond à une Route. Prend en parametre une collection de route pour s'instancier

//Récupérer adresse
$pathInfo = $request->getPathInfo();     //getPathInfo() récupère tout ce qu'il ya derrière index.php    ex: /hello

//Puisque le UrlMatcher->macth genere une exception si aucune route match, on utilise un try catch
try {
    //Retourne un tableau avec la route et les parametres
    $resultat = $urlMatcher->match($pathInfo);

    //Stocker dans request à envoyer à notre function d'url le resultat retourné par urlMatcher
    $request->attributes->add($resultat);

    //Appeler la fonction lié à la route stocker dans la variable callable dans parametre de resultat
    $response = call_user_func($resultat['_controller'], $request);

}catch(ResourceNotFoundException $e){
    $response = new Response("La page demandé n'existe pas", 404);
}catch(Exception $e){
    $response = new Response("Une erreur est survenu sur le serveur", 500);
}

$response->send();
