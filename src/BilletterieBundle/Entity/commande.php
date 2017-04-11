<?php

namespace BilletterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="BilletterieBundle\Repository\commandeRepository")
 */
class commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="BilletterieBundle\Entity\billet", mappedBy="order", cascade={"persist"})
     * @Assert\Valid()
     */
    private $billets;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_visite", type="date")
     * @Assert\Date(message="Date invalide")
     * @Assert\NotBlank(message="Veuillez sélectionner une date de visite")
     */
    private $dateVisite;

    /**
     * @var string
     *
     * @ORM\Column(name="type_billet", type="string", length=255)
     */
    private $typeBillet;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_billet", type="integer")
     */
    private $nbBillet;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="date")
     * @Assert\Email(message="Adresse E-mail invalide")
     * @Assert\NotBlank(message="Veuillez renseigner votre adresse E-mail")
     */
    private $dateCommande;

    private $prixTotale;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateVisite
     *
     * @param \DateTime $dateVisite
     *
     * @return commande
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    /**
     * Get dateVisite
     *
     * @return \DateTime
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
    }

    /**
     * Set typeBillet
     *
     * @param string $typeBillet
     *
     * @return commande
     */
    public function setTypeBillet($typeBillet)
    {
        $this->typeBillet = $typeBillet;

        return $this;
    }

    /**
     * Get typeBillet
     *
     * @return string
     */
    public function getTypeBillet()
    {
        return $this->typeBillet;
    }

    /**
     * Set nbBillet
     *
     * @param integer $nbBillet
     *
     * @return commande
     */
    public function setNbBillet($nbBillet)
    {
        $this->nbBillet = $nbBillet;

        return $this;
    }

    /**
     * Get nbBillet
     *
     * @return int
     */
    public function getNbBillet()
    {
        return $this->nbBillet;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return commande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * @return mixed
     */
    public function getBillets()
    {
        return $this->billets;
    }

    /**
     * @param mixed $billet
     */
    public function setBillets($billets)
    {
        $this->billet = $billets;
    }

    /**
     * @return mixed
     */
    public function getPrixTotale()
    {
        return $this->prixTotale;
    }

    /**
     * @param mixed $prixTotale
     */
    public function setPrixTotale($prixTotale)
    {
        $this->prixTotale = $prixTotale;
    }
}

