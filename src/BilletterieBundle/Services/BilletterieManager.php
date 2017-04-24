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


    public function calculPrix(commande $commande){
        // on recupère les billets
        $billets = $commande->getBillets();

        if (is_array($billets)){
            foreach ($billets  as $billet){
                $dateOfBirth = $billet->getVisiteurDateNaissance();
                $age = $dateOfBirth->diff(new \DateTime());
                $reduction = $billet->getTarifReduit();
                $demieJournée = $commande->getTypeBillet();

                $billet->setPrixBillet( (16.00));
                if ($age->y < 4) {
                    $billet->setPrixBillet( (0.00));
                }elseif ($age->y >= 4 && $age->y <= 12){
                    $billet->setPrixBillet( (8.00));
                }elseif ($age->y >= 60 ){
                    $billet->setPrixBillet( (12.00));
                }
                if ($reduction === true){
                    $billet->setPrixBillet( (10.0));
                }

                if ($demieJournée === 'demi-journée'){
                    $billet->setPrixBillet($billet->getPrixBillet()/2);
                }
            }
        }

    }


    public function compteBillet(commande $commande)
    {
        $billets = $commande->getBillets();
        $compteurBillet = 0;
        if (is_array($billets)){
            foreach ($billets as $billet) {
                $compteurBillet++;
            }
        }
        $commande->setNbBillet($compteurBillet);
    }

    // Calcul du tarif
    public function calculPrice($age, $reducedPrice, $typeBillet) {
        $price = 16;

        if ($age < 4) {
            $price = 0;
        } elseif ($age > 4 && $age < 12) {
            $price = 8;
        } elseif ($age > 60) {
            $price = 12;
        }

        if ($reducedPrice == true) {
            $price = 10;
        }

        if ($typeBillet == 'demi-journée'){
            $price = $price / 2;
        }

        return $price;
    }

}