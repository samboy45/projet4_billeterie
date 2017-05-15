<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 20/04/2017
 * Time: 16:29
 */

namespace BilletterieBundle\Services;




use BilletterieBundle\Entity\commande;

class BilletterieManager
{
    const A = 16;
    const B = 12;
    const C = 10;
    const D = 8;
    const E = 0;


    // Calcul du tarif
    public function calculPrice($age, $reducedPrice, $typeBillet)
    {
        $price = self::A;

        if ($age < 4) {
            $price = self::E;
        } elseif ($age > 4 && $age < 12) {
            $price = self::D;
        } elseif ($age > 60) {
            $price = self::B;
        }

        if ($reducedPrice == true) {
            $price = self::C;
        }

        if ($typeBillet == 'demi-journée') {
            $price = $price / 2;
        }

        return $price;
    }

    /*
     * traitement commande
     */

    public function traitement($commande,$em)
    {
        $billets = $commande->getBillets();
        // On vérifie que les valeurs entrées sont correctes
        foreach ($billets as $billet){
            $dateOfBirth = $billet->getVisiteurDateNaissance();
            $age = $dateOfBirth->diff(new \DateTime());
            $reduction = $billet->getTarifReduit();
            $typeBillet = $commande->getTypeBillet();
            $prix =$this->calculPrice($age->y,$reduction,$typeBillet);
            $billet->setPrixBillet($prix);
        }
        $this->compteBillet($commande);
        $em->persist($commande);
        $em->flush();

    }

    /*
     * tarif
     */
    public function tarif()
    {
        $tarif = array('0.00' => 'Tarif enfant, moins de 4 ans',
            '8.00' => 'Tarif enfant, 4 à 12 ans',
            '10.00' => 'Tarif réduit',
            '12.00' => 'Tarif senior, à partir de 60 ans',
            '16.00' => 'Tarif normal');
        return $tarif;
    }


    /**
     * @param commande $commande
     * compte le nombre de billet dans une commande
     */
    public function compteBillet(commande $commande)
    {
        $totalBillets = 0;
        $billets = $commande->getBillets();
        foreach ($billets as $billet){
            $nbBillets = count($billet);
            $totalBillets += $nbBillets ;
        }
        $commande->setNbBillets($totalBillets);
    }

    /*
     * vérifie l'achat d'un billet journée après 14h
     */
    public function  verifTypeBillet($commande)
    {

        $typeBillet = $commande->getTypeBillet();
        $dateReservation = $commande->getDateCommande()->getTimestamp();
        $heure = date( "H",$dateReservation);

        if ($typeBillet == "journée" && $heure >= '14'){
            $reponse = "echec";

        }else{
            $reponse = "ok";
        }
        return $reponse ;
    }
}