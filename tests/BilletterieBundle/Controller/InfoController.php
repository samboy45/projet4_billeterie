<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 18/05/2017
 * Time: 09:27
 */

namespace tests\BilletterieBundle\Controller;





use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InfoController extends WebTestCase
{
    private $client;
    private $crawler;

    protected function setUp() {

        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/info');
    }

    public function testPageInfo()
    {
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        //Si la page s'affiche
        $this->assertContains(
            '<h2>Horaires et Tarifs </h2>', $this->client->getResponse()->getContent()
        );

        $this->assertContains(
            '<div class="title">Tarifs</div>', $this->client->getResponse()->getContent()
        );

    }
}
