<?php

namespace App\Controller\Admin;


use App\Entity\Image;
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
 * @Route("/admin")
 *
 */
class TrickAdminController extends Controller
{
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

           return $this->redirect($this->generateUrl('app_image_list'));
       }


        return $this->render('admin/new.html.twig', array(
            'trickForm' => $form->createView(),
        ));
    }
}