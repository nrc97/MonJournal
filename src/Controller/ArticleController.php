<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Auteur;
use App\Form\ArticleType;
use App\Model\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/article/tous", name="article_tous")
     * @param ArticleService $articleService
     * @return Response
     */
    public function tous(ArticleService $articleService): Response
    {
        $tousLesArticles = $articleService->rechercherTouLesArticles();
        $articlesDuJour = $articleService->rechercherArticlesDuJour();

        //dump($tousLesArticles);
        //dump($articlesDuJour);

        return $this->render('article/tous.html.twig', [
            'tousLesArticles' => $tousLesArticles,
            'articlesDuJour' => $articlesDuJour
        ]);
    }

    /**
     * @Route(
     *     "/article/lire/{id}",
     *     name="article_lire",
     *     requirements={"id"="\d+"}
     * )
     */
    public function lire($id, ArticleService  $articleService): Response
    {

        $article = $articleService->rechercherArticleParId($id);

        //dump($article);

        return $this->render('article/lire.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/article/creer", name="article_creer")
     */
    public function creer(ArticleService $articleService, Request $request): Response
    {
        // 1.Instanciation de l'entité à remplir avce le formulaire
        $article = new Article();

        // 2. Creation du formulaire via la classe de formulaire, et associaton de l'entité
        $form = $this->createForm(
            ArticleType::class,
            $article
        );

        // 3. Traitement de la requete - L'objet Symfony\Component\HttpFoundation\Request doit être ajouté en tant que paramètre de la méthode
        $form->handleRequest($request);

        // 4. Test pour savoir si le formulaire doit être affiché ou soumis
        if ($form->isSubmitted() && $form->isValid()) {
            // POST
            $articleService->ajouterArticle($article);

            return $this->redirect(
                $this->generateUrl('article_lire', ['id' => $article->getId()])
            );
        }
        else {
            // GET
            return $this->render(
                'article/creer.html.twig',
                ['ajouterForm' => $form->createView()]
            );
        }
    }

    /**
     * @Route(
     *     "/article/modifier/{id}",
     *     name="article_modifier",
     *     requirements={"id":"\d+"}
     * )
     */
    public function modifier($id, ArticleService $articleService, Request $request): Response
    {

        // 1.Recupération de l'article à récupérer en base
        $article = $articleService->rechercherArticleParId($id);


        // 2. Creation du formulaire via la classe de formulaire, et associaton de l'entité
        $form = $this->createForm(
            ArticleType::class,
            $article
        );

        // 3. Traitement de la requete - L'objet Symfony\Component\HttpFoundation\Request doit être ajouté en tant que paramètre de la méthode
        $form->handleRequest($request);

        // 4. Test pour savoir si le formulaire doit être affiché ou soumis
        if ($form->isSubmitted() && $form->isValid()) {
            // POST
            $articleService->modifierArticle($article);

            return $this->redirect(
                $this->generateUrl('article_lire', ['id' => $article->getId()])
            );
        }
        else {
            // GET
            return $this->render(
                'article/modifier.html.twig',
                ['modifierForm' => $form->createView()]
            );
        }
    }

    /**
     * @Route(
     *     "/article/supprimer/{id}",
     *     name="article_supprimer",
     *     requirements={"id"="\d+"}
     * )
     */
    public function supprimer($id, ArticleService $articleService): Response
    {
        $articleService->supprimerArticle($id);
//        return $this->render('article/supprimer.html.twig', [
//           'controller_name' => 'ArticleController',
//        ]);

        $this->addFlash('suppression', 'Article supprimé');

        return $this->redirect(
            $this->generateUrl('accueil')
        );
    }


}
