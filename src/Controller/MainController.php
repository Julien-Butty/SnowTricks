<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @param Tricks $trick
     * @return Response
     * @Route("/trick/{title}", name="trick_show")
     */
    public function showAction(Tricks $trick)
    {

        return $this->render('Tricks/show.html.twig', array(
            'trick'=> $trick,

        ));


    }


}
