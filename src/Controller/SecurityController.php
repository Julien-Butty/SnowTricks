<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 11/02/2018
 * Time: 09:42
 */

namespace App\Controller;


use App\Form\LoginFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/login", name="security_login")
     */
    public function loginAction()
  {
      $authenticationUtils = $this->get('security.authentication_utils');

      $error = $authenticationUtils->getLastAuthenticationError();

      $lastUsername = $authenticationUtils->getLastUsername();

      $form = $this->createForm(LoginFormType::class, [
          '_username' => $lastUsername,
      ]);

      return $this->render('security/login.html.twig', [
          'form' => $form->createView(),
          'error' => $error,
      ]);

      }

    /**
     * @Route("/logout", name="security_logout")
     */
      public function logoutAction()
      {
          throw new \Exception('this should not be reached');
      }
}
