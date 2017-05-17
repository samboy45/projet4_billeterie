<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 10/05/2017
 * Time: 15:19
 */

namespace BilletterieBundle\Services;



class StripeService
{

    public function payementCommande($commande)
    {

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_ujE3Mg2OxOUgvNVlXEzLcRG0');

        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];

        // Create a charge: this will charge the user's card
        try {
            \Stripe\Charge::create(array(
                "amount" => $commande->getPrixTotale() * 100, // Amount in cents
                "currency" => "eur",
                "source" => $token,
            ));
            $status = "validate";
        } catch(\Stripe\Error\Card $e) {
            // The card has been declined
            $status = "echec";
        }

        return $status;
    }

}