<?php

namespace BilletterieBundle\Controller;

use BilletterieBundle\Entity\commande;
use BilletterieBundle\Form\commandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class BilletterieController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $commande = new  commande();
        $form =$this->createForm(commandeType::class, $commande);
        $em = $this->getDoctrine()->getManager();


        // Si la requête est un post
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // On vérifie que les valeurs entrées sont correctes
            $this->get('Billetterie.BilletterieManager')->calculPrix($commande);
            $this->get('Billetterie.BilletterieManager')->compteBillet($commande);
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('validation', array('id' => $commande->getId()));
        }

        return $this->render('BilletterieBundle:Order:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/validation/{id}", name="validation",  requirements={"id": "\d+"})
     */
    public function validationAction(Request $request, commande $commande)
    {
        return $this->render('BilletterieBundle:Order:validation.html.twig', array(
            'commande' => $commande,
            'billets' => $commande->getBillets()
        ));
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
