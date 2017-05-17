<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 17/05/2017
 * Time: 22:56
 */

namespace tests\BilletterieBundle\Entity;


use BilletterieBundle\Entity\commande;


class commandeTest extends \PHPUnit_Framework_TestCase
{

    public function testcommandeMethods()
    {
        $commande = new commande();
        $commande
            ->setDateVisite(new \DateTime('2017-05-17'))
            ->setTypeBillet('journee')
            ->setNbBillets('5')
            ->setEmail('john@doe.fr')
            ->setDateCommande(new \DateTime('2017-05-17'));

        $this->assertEquals(new \DateTime('2017-05-17'), $commande->getDateVisite());
        $this->assertEquals('journee', $commande->getTypeBillet());
        $this->assertEquals('5', $commande->getNbBillets());
        $this->assertEquals('john@doe.fr', $commande->getEmail());
        $this->assertEquals(new \DateTime('2017-05-17'), $commande->getDateCommande());
    }

}
