<?php

namespace App\Tests;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{

    private $article;

    public function setUp() {
        echo "setUp() \n";

        $this->article = new Article();

        $this->article->setTitre("Titre de l'article.");
        $this->article->setIntro("Introduction de l'article.");
        $this->article->setTexte("Texte de l'article.");
        $this->article->setDatePublication(\DateTime::createFromFormat("Y-m-d H:i:s", date("Y-m-d H:i:s")));
    }

    public function tearDown() {
        echo "tearDown() \n";
    }

    public static function setUpBeforeClass()
    {
        echo "setUpBeforeClass() \n";
    }

    public static function tearDownAfterClass()
    {
        echo "tearDownAfterClass \n";
    }

    public function testGetTitre()
    {
        echo "testGetTitre() \n";
        $titre = $this->article->getTitre();

        $this->assertEquals("Titre de l'article.", $titre);
    }

    public function testGetIntro()
    {
        echo "testGetIntro() \n";
        $intro = $this->article->getIntro();
        $this->assertEquals("Introduction de l'article.", $intro);
    }

}
