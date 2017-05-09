<?php

namespace BilletterieBundle\Controller;

use BilletterieBundle\Entity\commande;
use BilletterieBundle\Form\commandeType;
use BilletterieBundle\Services\BilletterieManager;
use Doctrine\Common\Collections\ArrayCollection;
use Stripe\Stripe;
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
            $this->get('Billetterie.BilletterieManager')->traitement($commande,$em);
            return $this->redirectToRoute('validation', array('id' => $commande->getId()));
        }

        return $this->render('BilletterieBundle:Order:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }



    /**
     * @Route("/edit/{id}", name="edit",  requirements={"id": "\d+"})
     */
    public function editAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('BilletterieBundle:commande')->find($id);

        if (!$commande){
            throw $this->createNotFoundException('pas de commande trouver pour l\'id ' . $id);
        }

        $originalBillets = new ArrayCollection();

        foreach ($commande->getBillets() as $billet){
            $originalBillets->add($billet);

        }

        $editForm = $this->createForm(commandeType::class, $commande);
        $editForm->handleRequest($request);

        if ($editForm->isValid()){
            foreach ($originalBillets as $billet){
                if (false === $commande->getBillets()->contains($billet)){
                    $em->remove($billet);
                }
            }
            $this->get('Billetterie.BilletterieManager')->traitement($commande,$em);
            return $this->redirectToRoute('validation', array('id' => $commande->getId()));
        }

        return $this->render('BilletterieBundle:Order:index.html.twig', array(
            'form' => $editForm->createView(), 'commande' => $commande
        ));
    }

    /**
     * @Route("/validation/{id}", name="validation",  requirements={"id": "\d+"})
     */
    public function validationAction(Request $request, commande $commande)
    {
        $price = $this->get('Billetterie.BilletterieManager')->tarif();
        $billets= $commande->getBillets();

        if ($request->isMethod('POST')) {
            Stripe::setApiKey("sk_test_ujE3Mg2OxOUgvNVlXEzLcRG0");

            // Get the credit card details submitted by the form
            $token = $_POST['stripeToken'];

            // Create a charge: this will charge the user's card
            try {
                \Stripe\Charge::create(array(
                    "amount" => $commande->getPrixTotale() * 100, // Amount in cents
                    "currency" => "eur",
                    "source" => $token,
                ));

                $this->addFlash("success", "Bravo ça marche !");

            } catch (\Stripe\Error\Card $e) {

                $this->addFlash("error", "Snif ça marche pas :(");
                return $this->redirectToRoute("validation", array('id' => $commande->getId()));
                // The card has been declined
            }
            return $this->redirectToRoute('home');
        }

        return $this->render('BilletterieBundle:Order:validation.html.twig', array(
            'commande' => $commande,
            'billets' => $billets,
            'totale' => $commande->getPrixTotale(),
            'price' => $price
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
