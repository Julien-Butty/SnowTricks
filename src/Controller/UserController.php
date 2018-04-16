<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgottenPasswordType;
use App\Form\ResetPasswordType;
use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            /** @var UploadedFile $file */
            $file = $user->getAvatar();
            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            $file->move(
                $this->getParameter('avatars_directory'),
                $fileName
            );
            $user->setAvatar($fileName);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Bienvenue ' . $user->getUsername());

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/forgotten_password", name="forgotten_password")
     * @throws \Exception
     */
    public function forgottenPassword(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ForgottenPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('App:User')
                ->findOneBy(array('email' => $data['email']));

            if (!$user) {
                $this->addFlash('danger', 'Email inexistant, veuillez créer un compte');

                return $this->redirectToRoute('homepage');
            }

            $token = base64_encode(random_bytes(10));

            $user->setResetToken($token);
            $em->flush();


            $mail = (new \Swift_Message('Réinitialisation de mot votre mot de passe'))
                ->setFrom('julienbutty@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'emails/resetPassword.html.twig',
                        array('user' => $user)
                    ),
                    'text/html'
                );

            $mailer->send($mail);

            $this->addFlash('success', 'Un mail vient de vous être envoyé.');

            return $this->redirectToRoute('homepage');


        }
        return $this->render('user/forgottenPassword.html.twig', [
            'forgottenPassword' => $form->createView(),

        ]);

    }

    /**
     * @Route("/reset_password/{resetToken}", name="reset_password")
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function resetPassword(Request $request, User $user, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(ResetPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->eraseCredentials();
            $em->flush();

            $this->addFlash('success', 'Votre mot de passe a bien été mis à jour');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/resetPassword.html.twig', [
            'resetPassword' => $form->createView(),

        ]);

    }
}
