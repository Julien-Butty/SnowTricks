<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\User;
use App\Form\ChatType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Trick;
use App\Entity\Image;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {

        $em = $this->getDoctrine()->getManager();

        $tricks = $em->getRepository('App:Trick')
            ->findAllById();

        return $this->render('Tricks/trickslist.html.twig', [
            'tricks' => $tricks,

        ]);
    }

    /**
     * @param Trick $trick
     * @param Request $request
     * @param AuthorizationCheckerInterface $checker
     * @param EntityManagerInterface $em
     * @return Response
     * @Route("/trick/{slug}", name="trick_show")
     */
    public function showAction(Trick $trick, Request $request, AuthorizationCheckerInterface $checker, EntityManagerInterface $em)
    {

        $form = $this->createForm(ChatType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            if (false === $checker->isGranted('ROLE_MANAGE_TRICKS')) {
                throw new AccessDeniedException('Vous devez être connecté pour poster un message.');
            }

            /** @var Chat $chat */
            $chat = $form->getData();


            $chat->setUser($this->getUser());
            $chat->setTrick($trick);

            $em->persist($chat);

            $em->flush();

        }


        return $this->render('Tricks/show.html.twig', array(
            'trick' => $trick,
            'chatForm' => $form->createView(),

        ));

    }


}
