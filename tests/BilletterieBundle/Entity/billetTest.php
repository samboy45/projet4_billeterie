<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 17/05/2017
 * Time: 22:39
 */

namespace tests\BilletterieBundle\Entity;


use BilletterieBundle\Entity\billet;


class billetTest extends \PHPUnit_Framework_TestCase
{
    public function testbilletMethods()
    {
        $billet = new billet();
        $billet
            ->setPrenomVisiteur('samba')
            ->setNomVisiteur('doucouré')
            ->setVisiteurPays('FR')
            ->setVisiteurDateNaissance(new \DateTime('1994-04-09'))
            ->setTarifReduit('0')
            ->setPrixBillet('16.00');

        $this->assertEquals('samba', $billet->getPrenomVisiteur());
        $this->assertEquals('doucouré', $billet->getNomVisiteur());
        $this->assertEquals('FR', $billet->getVisiteurPays());
        $this->assertEquals(new \DateTime('1994-04-09'), $billet->getVisiteurDateNaissance());
        $this->assertEquals('0', $billet->getTarifReduit());
        $this->assertEquals('16.00', $billet->getPrixBillet());
    }

}
