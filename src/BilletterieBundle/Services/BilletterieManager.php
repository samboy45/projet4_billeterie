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
        $price = self::A ;

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

        if ($typeBillet == 'demi-journée'){
            $price = $price / 2;
        }

        return $price;
    }

}