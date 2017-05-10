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
    private $stripekey;
    public function __construct($stripekey)
    {
        $this->stripekey = $stripekey;
    }

    public function payementCommande($commande)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey($this->stripekey);

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