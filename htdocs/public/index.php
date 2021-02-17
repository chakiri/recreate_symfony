<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/../vendor/autoload.php';

//createFromGlobals : Puise dans toutes les super global et crée un objet avec toutes ces informations
$request = Request::createFromGlobals();

$response = new Response();

$pathInfo = $request->getPathInfo();     //getPathInfo() récupère tout ce qu'il ya derrière index.php    ex: /hello

//On crée une map pour stocker le chemain de chaque path
$map = [
    '/hello' => 'hello.php',
    '/bye' => 'bye.php',
    '/about' => 'about.php'
];

if ($map[$pathInfo]){
    extract($request->query->all());    //$request->query représente les parametres de l'url.   //Extract genère les variables à partir d'un tableau associatif. De cette manière là la variable $name est automatiquement générer depuis le tableau associatif $_GET. Donc plus besoin de la récupérer dans le fichier hello.php
    ob_start();     //Création de tampon pour inclure le fichier dedans car on souhaite envoyer la reponse uniquement via $response->send() et pas utiliser include qui affiche lui même le resultat
    include __DIR__ . '/../src/pages/' . $map[$pathInfo];       //Include se stock dans le tampon
    $response->setContent(ob_get_clean());
}else{
    $response->setContent("La page demandé n'existe pas");
    $response->setStatusCode(404);
}

$response->send();
