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



        // Si la requête est un post
        if ($request->isMethod('POST')){
            // On vérifie que les valeurs entrées sont correctes
            $form->handleRequest($request);

            //Vérification des valeurs
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($commande);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                return $this->redirectToRoute('home');
            }
        }

        return $this->render('BilletterieBundle:Order:index.html.twig', array(
            'form' => $form->createView(),
        ));
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
