<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 10/05/2017
 * Time: 15:04
 */

namespace BilletterieBundle\Services;



class MailService
{
    private $mailer;
    private $twig;
    private $manager;
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, BilletterieManager $billetterieManager)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->manager = $billetterieManager ;
    }


    public function sendMail($commande)
    {
        $message = new \Swift_Message();
        $tarif = $this->manager->tarif();

        $message
            ->setSubject('Confirmation de commande')
            ->setFrom(array('john@doe.com' => 'Musée du Louvre'))
            ->setTo($commande->getEmail())
            ->setContentType('text/html')
            ->setBody($this->twig->render('BilletterieBundle:Order:mail.html.twig', array(
                'commande' => $commande,
                'billets' => $commande->getBillets(),
                'totale' => $commande->getPrixTotale(),
                'price' => $tarif
            )));

        $this->mailer->send($message);
    }

}