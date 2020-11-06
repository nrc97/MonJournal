<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerFuncTest extends WebTestCase
{

    private static $client;

    public static function setUpBeforeClass()
    {
        self::$client = static::createClient(
            [],
            ['HTTP_HOST' => "monjournal.formation.fr"] //Adresse de base du site
        );
    }

    public function testTous()
    {

        $crawler = self::$client->request('GET', '/article/tous');

        $this->assertResponseIsSuccessful();        // Response est de type 200: OK
        $this->assertSelectorTextContains('h1', 'Bienuvenue sur MonJournal!');

        $contenuReponse = self::$client->getResponse()->getContent();

        $this->assertContains('Les articles du jour !', $contenuReponse);
        $this->assertContains('Tous les articles', $contenuReponse);
    }
}
