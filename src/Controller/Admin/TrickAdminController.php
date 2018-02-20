<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\User;
use App\Entity\Tricks;
use App\Form\ImageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;


/**
 * Class TrickAdminController
 * @package App\Controller\Admin
 * @Security("is_granted('ROLE_MANAGE_TRICKS')")
 * @Route("/admin")
 *
 */
class TrickAdminController extends Controller
{

    public function indexAction()
    {

    }

    /**
     * @param Request $request
     * @Route("/trick/new", name="admin_trick_new")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        $image = new Image();
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $image);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $images = $trick->getImages();
//            foreach($images in $image){}
            $file = $image->getUrl();
            $fileName = $fileUploader->upload($file);

            $image->setUrl($fileName);

            $em->persist($trick);
            $em->flush();

            $this->addFlash('success',
                sprintf('Merci %s, vous venez de créer une figure', $this->getUser()->getUsername()));
            return $this->redirect($this->generateUrl('app_image_list'));
        }
        return $this->render('admin/new.html.twig', array(
            'trickForm' => $form->createView(),
        ));
    }

    /**
     * @Route("/trick/{title}/edit", name="admin_trick_edit")
     * @param Request $request
     * @param Tricks $tricks
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request, Tricks $tricks)
    {
        $form = $this->createForm(TricksFormType::class, $tricks);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tricks = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tricks);
            $em->flush();
            $this->addFlash('success', 'Yeahhh !!! Le Trick est mis à jour');
            return $this->redirectToRoute('homepage');
        }
        return $this->render('Admin/Trick/edit.html.twig',[
            'trickForm' => $form->createView()
        ]);
    }
}