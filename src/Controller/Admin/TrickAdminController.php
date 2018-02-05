<?php

namespace App\Controller\Admin;


use App\Entity\Image;
use App\Entity\Tricks;
use App\Entity\User;
use App\Entity\TrickGroup;
use App\Form\ImageType;
use App\Form\TricksFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;


/**
 * Class TrickAdminController
 * @package App\Controller\Admin
 * @Route("/admin")
 *
 */
class TrickAdminController extends Controller
{
    /**
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param Tricks $tricks
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/trick/new", name="admin_trick_new")
     */
    public function newAction(Request $request)
    {
//        $image = new Image();


       $form = $this->createForm(TricksFormType::class);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

           $tricks = $form->getData();
           $em = $this->getDoctrine()->getManager();

//            $images = $tricks->getImages();
//            foreach($images in $image){}
//           $file = $image->getUrl();
//           $fileName = $fileUploader->upload($file);


//           $image->setUrl($fileName);

           $em->persist($tricks);
           $em->flush();

           $this->addFlash(
               'succes','Merci, votre figure a bien été ajoutée!');

//           return $this->redirect($this->generateUrl('app_image_list'));
           return $this->redirectToRoute('homepage');
       }


        return $this->render('Admin/Trick/new.html.twig', array(
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