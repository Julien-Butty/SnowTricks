<?php

namespace App\Controller\Admin;


use App\Entity\Trick;
use App\Form\TricksFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TrickAdminController
 * @package App\Controller\Admin
 * @Security("is_granted('ROLE_MANAGE_TRICKS')")
 * @Route("/admin/trick")
 *
 */
class TrickAdminController extends Controller
{

    public function indexAction()
    {

    }

    /**
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/new", name="admin_trick_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TricksFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();
            $trick->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();

            $this->addFlash('success',
                sprintf('Merci %s, vous venez de créer une figure', $this->getUser()->getUsername()));
            return $this->redirect($this->generateUrl('homepage'));
        }
        return $this->render('Admin/Trick/new.html.twig', array(
            'trickForm' => $form->createView(),
        ));

    }


    /**
     * @Route("/{slug}/edit", name="admin_trick_edit")
     * @param Request $request
     * @param Trick $trick
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request, Trick $trick)
    {
        if (!$trick) {
            throw $this->createNotFoundException('Cette figure n\'existe pas');
        }

        $form = $this->createForm(TricksFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'Yeahhh !!! Le Trick est mis à jour');
            return $this->redirectToRoute('homepage');
        }
        return $this->render('Admin/Trick/edit.html.twig', [
            'trickForm' => $form->createView(),
            'trick' => $trick
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Trick $trick
     * @return Response
     */
    public function delete(Request $request, Trick $trick): Response
    {
        if (!$this->isCsrfTokenValid('delete' . $trick->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('homepage');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($trick);
        $em->flush();

        $this->addFlash('success', 'La figure a été supprimée !');
        return $this->redirectToRoute('homepage');
    }
}
