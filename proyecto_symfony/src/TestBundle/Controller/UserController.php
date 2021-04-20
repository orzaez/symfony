<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

// class DefaultController extends Controller
// {
//     /**
//      * @Route("/")
//      */
//     public function indexAction($name)
//     {
//         return $this->render('TestBundle:Default:index.html.twig');
//     }
// }

class UserController extends Controller
{
   
    public function indexAction()
    {
        return new Response('Bienvendio');
    }

    public function articlesAction($articulo)
    {
        return new Response('Articulo numero ' . $articulo);
    }
}
