<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 17/05/2017
 * Time: 15:22
 */

namespace tests\BilletterieBundle\Service;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class BilletterieManagerTest extends WebTestCase
{
    private $client;
    private $billetterrieManager;

    protected function setUp() {

        $this->client = self::createClient();
        $container = $this->client->getContainer();
        $this->billetterrieManager = $container->get('billetterie.billetteriemanager');
    }

    public function testPrice(){
        // Gratuit moins de 4 ans
        $age = 0;
        $prix = $this->billetterrieManager->calculPrice($age, false, 'journée');
        $this->assertEquals(0, $prix);

        // Tarif enfant
        $age = 5;
        $prix = $this->billetterrieManager->calculPrice($age, false, 'journée');
        $this->assertEquals(8, $prix);

        // Tarif normal en demi-journée
        $age = 12;
        $prix = $this->billetterrieManager->calculPrice($age, false, 'demi-journée');
        $this->assertEquals(8, $prix);

        // Senior en demi-journée
        $age = 61;
        $prix = $this->billetterrieManager->calculPrice($age, false, 'demi-journée');
        $this->assertEquals(6, $prix);

        // Tarif réduit en demi-journée
        $age = 25;
        $prix = $this->billetterrieManager->calculPrice($age, true, 'demi-journée');
        $this->assertEquals(5, $prix);

    }




}
