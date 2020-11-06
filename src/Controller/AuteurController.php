<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\ArticleType;
use App\Form\AuteurType;
use App\Model\AuteurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur/tous", name="auteur_tous")
     */
    public function tous(AuteurService $auteurService): Response
    {
        $tousLesAuteurs = $auteurService->rechercherTousLesAuteurs();

        //dump($tousLesAuteurs);

        return $this->render('auteur/tous.html.twig', [
            'tousLesAuteurs' => $tousLesAuteurs,
        ]);
    }

    /**
     * @Route(
     *     "/auteur/afficher/{identifiant}",
     *     name="auteur_afficher"
     * )
     * @return Response
     */
    public function afficher($identifiant, AuteurService $auteurService): Response
    {
        $auteur = $auteurService->rechercherAuteurParIdentifiant($identifiant);

        //dump($auteur);

        return $this->render('auteur/afficher.html.twig', [
            'auteur' => $auteur,
        ]);
    }

    /**
     * @Route("/auteur/creer", name="auteur_creer")
     */
    public function creer(AuteurService $auteurService, Request $request): Response
    {
        $auteur = new Auteur();

        $form = $this->createForm(
            AuteurType::class,
            $auteur
        );

        $form->handleRequest($request);

        if ($form -> isSubmitted()  && $form->isValid()) {
            $auteurService->ajouterAuteur($auteur);

            return $this->redirect(
                $this->generateUrl('auteur_afficher', ['identifiant' => $auteur->getIdentifiant()])
            );
        } else {
            return $this->render(
                'auteur/creer.html.twig',
                ['ajouterForm' => $form->createView()]
            );
        }
    }

    /**
     * @Route(
     *     "/auteur/modifier/{identifiant}",
     *     name="auteur_modifier"
     * )
     */
    public function modifier($identifiant, AuteurService $auteurService, Request $request): Response
    {
        $auteur = $auteurService->rechercherAuteurParIdentifiant($identifiant);
        $form = $this->createForm(
            AuteurType::class,
            $auteur
        );

        $form->handleRequest($request);

        if ($form -> isSubmitted() && $form->isValid()) {
            $auteurService->modifierAuteur($auteur);

            return $this->redirect(
                $this->generateUrl('auteur_afficher', ['identifiant' => $auteur->getIdentifiant()])
            );
        } else {
            return $this->render(
                'auteur/modifier.html.twig',
                ['modifierForm' => $form->createView()]
            );
        }
    }
}
