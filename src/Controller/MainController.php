<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {

        $em = $this->getDoctrine()->getManager();

       $tricks = $em->getRepository('App:Tricks')
           ->findAllById();



        return $this->render('Tricks/trickslist.html.twig',[
            'tricks' => $tricks
        ]);
    }
}
