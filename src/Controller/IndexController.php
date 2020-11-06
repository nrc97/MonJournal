<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        // On renvoie vers la page/l'action d'affichage de tous les articles
        // On fait une delegation vers l'action 'tous' de 'ArticleController'

        return $this->forward('App\Controller\ArticleController::tous');
    }
}
