<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Video;
use App\Form\ImageType;
use App\Form\TricksFormType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $trick = new Trick();


        $form = $this->createForm(TricksFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();

            $images = $trick->getImages();
            $videos = $trick->getVideos();


            foreach ($images as $image) {

                /** @var UploadedFile $file */
                $file = $image->getFile();

                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                $image->setUrl($fileName);
                $image->setTrick($trick);

            }

            foreach ($videos as $video) {

                $video->setTrick($trick);
                $video->extractIdentif();
                $video->setDate(new \DateTime());

            }


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
     * @param Trick $tricks
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request, Trick $trick)
    {
//        $trick->setUrl(new File($this->getParameter('images_directory').'/'.$trick->getImages()));



        if (!$trick) {
            throw $this->createNotFoundException('Cette figure n\'existe pas');
        }
dump($trick->getImages());
        $form = $this->createForm(TricksFormType::class, $trick);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
              dump($trick);
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
     * @Route("/{id}/delete", name="delete", methods="DELETE")
     * @param Request $request
     * @param Trick $trick
     * @return Response
     */
    public function delete(Request $request, Trick $trick): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('trick_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($trick);
        $em->flush();

        $this->addFlash('success', 'La figure a été supprimée !');
        return $this->redirectToRoute('homepage');
    }

}