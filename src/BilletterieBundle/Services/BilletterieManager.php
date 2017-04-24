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

                $billet->setPrixBillet( number_format(16.00, 2));
                if ($age->y < 4) {
                    $billet->setPrixBillet( number_format(0.00, 2));
                }elseif ($age->y >= 4 && $age->y <= 12){
                    $billet->setPrixBillet( number_format(8.00, 2));
                }elseif ($age->y >= 60 ){
                    $billet->setPrixBillet( number_format(12.00, 2));
                }
                if ($reduction == true){
                    $billet->setPrixBillet( number_format(10.00, 2));
                }

                if ($demieJournée == 'demi-journée'){
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

}