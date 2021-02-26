<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GreetingController{

    public function hello(Request $request){
        //Get data from request attributes
        $_route = $request->attributes->get('_route');
        $name = $request->attributes->get('name');

        //integrer html
        ob_start();
        include __DIR__ . '/../pages/' . $_route . '.php';

        //Renvoyer reponse
        return new Response(ob_get_clean());
    }

    public function bye(Request $request){
        //Get data from request attributes
        $_route = $request->attributes->get('_route');

        //integrer html
        ob_start();
        include __DIR__ . '/../pages/' . $_route . '.php';

        //Renvoyer reponse
        return new Response(ob_get_clean());
    }

    public function about(Request $request){
        //Get data from request attributes
        $_route = $request->attributes->get('_route');

        //integrer html
        ob_start();
        include __DIR__ . '/../pages/' . $_route . '.php';

        //Renvoyer reponse
        return new Response(ob_get_clean());
    }
}