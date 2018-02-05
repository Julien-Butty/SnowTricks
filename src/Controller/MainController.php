<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Tricks;
use App\Entity\Image;

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

    /**
     * @param $trickName
     * @return Response
     * @Route("/trick/{trickName}", name="trick_show")
     */
    public function showAction($trickName)
    {
        $em = $this->getDoctrine()->getManager();

        $trick = $em->getRepository('App:Tricks')
            ->findOneBy(['title' => $trickName]);





        if (!$trickName) {
            throw $this->createNotFoundException('Cette figure n\'existe pas !!!');
        }

        return $this->render('Tricks/show.html.twig', array(
            'trick'=> $trick,

        ));


    }


}
