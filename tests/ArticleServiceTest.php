<?php

namespace App\Tests;

use App\Entity\Article;
use App\Model\ArticleService;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class ArticleServiceTest extends TestCase
{
    private $article;

    protected function setUp()
    {
        $this->article = new Article();

        $this->article->setTitre("Titre de l'article.");
        $this->article->setIntro("Introduction de l'article.");
        $this->article->setTexte("Texte de l'article.");
        $this->article->setDatePublication(\DateTime::createFromFormat("Y-m-d H:i:s", date("Y-m-d H:i:s")));
    }

    public function testAjouterArticle()
    {
        $this->assertTrue(true);
        // On simule l'entity manager
        $em = $this->createMock(EntityManager::class);

        // On decrity ce qui doit se passe se passeer dans la methode testée : ajouterArticle()

        $em->expects($this->any())
            ->method('persist')
            ->method('flush')
            ->willReturn('void');

        // On appelle la methode

        $articleService = new ArticleService();
        $articleService->ajouterArticle($this->article);
    }
}
