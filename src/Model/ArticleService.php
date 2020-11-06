<?php


namespace App\Model;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleService
{

    // Attribut qui reference l'EntityManager de Doctrine
    private $em;

    // Constructeur qui va recevoir par injection l'EntityManager de Doctrine
    // Le type 'EntityManagerInterface' permet à Symfony de savoir quel objet injecter
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function ajouterArticle(Article $article) {
        try {
            $this->em->persist($article);
            $this->em->flush();
        } catch (\Exception $e) {
            // Journaliser l'erreur technique...

            // Generer une Exception avec un message fonctionnel
            throw new \Exception("Erreur lors de l'enregistrement de l'article.", null, $e);
        }

    }

    public function modifierArticle(Article $article) {
        try {
            $this->em->persist($article);
            $this->em->flush();
        } catch (\Exception $e) {
            // Journaliser l'erreur technique...

            // Generer une Exception avec un message fonctionnel
            throw new \Exception("Erreur lors de la mise à jour de l'article.", null, $e);
        }
    }

    public function supprimerArticle(int $id) {
        try {
            $repo = $this->em->getRepository('App:Article');
            $article = $repo->find($id);
            $this->em->remove($article);
            $this->em->flush();
        }
        catch (\Exception $e) {
            throw new \Exception("Erreur lors de la suppression de l'article.", null, $e);
        }

    }

    public function rechercherTouLesArticles() {
        try {
            return $this->em->getRepository('App:Article')
                ->findAll();
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la recuperation des articles.", null, $e);
        }

    }

    public function rechercherArticleParId(int $id) {
        try {
            return $this->em->getRepository('App:Article')
                ->find($id);
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la recuperation de l'article d'id $id.", null, $e);
        }
    }

    public function rechercherArticlesDuJour() {
       return $this->em->getRepository('App:Article')
           ->findTodayDQL();
    }

}