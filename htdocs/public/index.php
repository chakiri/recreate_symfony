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
    $resultat = $urlMatcher->match($pathInfo);  //Retourne un tableau avec la route et les parametres

    //extract($request->query->all());    //$request->query représente les parametres de l'url.   //Extract genère les variables à partir d'un tableau associatif. De cette manière là la variable $name est automatiquement générer depuis le tableau associatif $_GET. Donc plus besoin de la récupérer dans le fichier hello.php

    //Extraire $resultat qui correspond au tableau avec les donnees de la route dont les parametres
    extract ($resultat);

    ob_start();     //Création de tampon pour inclure le fichier dedans car on souhaite envoyer la reponse uniquement via $response->send() et pas utiliser include qui affiche lui même le resultat
    include __DIR__ . '/../src/pages/' . $_route . '.php';       //Include se stock dans le tampon
    $response = new Response(ob_get_clean());
}catch(ResourceNotFoundException $e){
    $response = new Response("La page demandé n'existe pas", 404);
}catch(Exception $e){
    $response = new Response("Une erreur est survenu sur le serveur", 500);
}

$response->send();
