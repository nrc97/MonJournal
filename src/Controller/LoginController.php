<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $auth): Response
    {
        // On recupère les éventuelles erreurs d'authentification précédentes pour afficher un message

        $erreur = $auth->getLastAuthenticationError();

        return $this->render('login/index.html.twig', [
            'erreur' => $erreur
        ]);
    }
}
