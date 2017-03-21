<?php

namespace BilletterieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BilletterieController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('BilletterieBundle:Order:index.html.twig');
    }

    /**
     * @Route("/validation", name="validation")
     */
    public function validationAction()
    {
        return $this->render('BilletterieBundle:Order:validation.html.twig');
    }

    /**
     * @Route("/confirmation", name="confirmation")
     */
    public function confirmationAction()
    {
        return $this->render('BilletterieBundle:Order:confirmation.html.twig');
    }

    /**
     * @Route("/info", name="info")
     */
    public function infoAction()
    {
        return $this->render('BilletterieBundle:Info:info.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('BilletterieBundle:Info:contact.html.twig');
    }

    /**
     * @Route("/cgv", name="cgv")
     */
    public function cgvAction()
    {
        return $this->render('BilletterieBundle:Info:cgv.html.twig');
    }
}
