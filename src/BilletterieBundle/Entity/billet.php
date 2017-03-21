<?php

namespace BilletterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="BilletterieBundle\Repository\billetRepository")
 */
class billet
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
     * @var int
     *
     * @ORM\Column(name="id_commande", type="integer")
     */
    private $idCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_visiteur", type="string", length=255)
     */
    private $nomVisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_visiteur", type="string", length=255)
     */
    private $prenomVisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="visiteur_pays", type="string", length=255)
     */
    private $visiteurPays;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visiteur_date_naissance", type="date")
     */
    private $visiteurDateNaissance;

    /**
     * @var bool
     *
     * @ORM\Column(name="tarif_reduit", type="boolean")
     */
    private $tarifReduit;

    /**
     * @var string
     *
     * @ORM\Column(name="prix_billet", type="decimal", precision=10, scale=2)
     */
    private $prixBillet;


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
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return billet
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    /**
     * Get idCommande
     *
     * @return int
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set nomVisiteur
     *
     * @param string $nomVisiteur
     *
     * @return billet
     */
    public function setNomVisiteur($nomVisiteur)
    {
        $this->nomVisiteur = $nomVisiteur;

        return $this;
    }

    /**
     * Get nomVisiteur
     *
     * @return string
     */
    public function getNomVisiteur()
    {
        return $this->nomVisiteur;
    }

    /**
     * Set prenomVisiteur
     *
     * @param string $prenomVisiteur
     *
     * @return billet
     */
    public function setPrenomVisiteur($prenomVisiteur)
    {
        $this->prenomVisiteur = $prenomVisiteur;

        return $this;
    }

    /**
     * Get prenomVisiteur
     *
     * @return string
     */
    public function getPrenomVisiteur()
    {
        return $this->prenomVisiteur;
    }

    /**
     * Set visiteurPays
     *
     * @param string $visiteurPays
     *
     * @return billet
     */
    public function setVisiteurPays($visiteurPays)
    {
        $this->visiteurPays = $visiteurPays;

        return $this;
    }

    /**
     * Get visiteurPays
     *
     * @return string
     */
    public function getVisiteurPays()
    {
        return $this->visiteurPays;
    }

    /**
     * Set visiteurDateNaissance
     *
     * @param \DateTime $visiteurDateNaissance
     *
     * @return billet
     */
    public function setVisiteurDateNaissance($visiteurDateNaissance)
    {
        $this->visiteurDateNaissance = $visiteurDateNaissance;

        return $this;
    }

    /**
     * Get visiteurDateNaissance
     *
     * @return \DateTime
     */
    public function getVisiteurDateNaissance()
    {
        return $this->visiteurDateNaissance;
    }

    /**
     * Set tarifReduit
     *
     * @param boolean $tarifReduit
     *
     * @return billet
     */
    public function setTarifReduit($tarifReduit)
    {
        $this->tarifReduit = $tarifReduit;

        return $this;
    }

    /**
     * Get tarifReduit
     *
     * @return bool
     */
    public function getTarifReduit()
    {
        return $this->tarifReduit;
    }

    /**
     * Set prixBillet
     *
     * @param string $prixBillet
     *
     * @return billet
     */
    public function setPrixBillet($prixBillet)
    {
        $this->prixBillet = $prixBillet;

        return $this;
    }

    /**
     * Get prixBillet
     *
     * @return string
     */
    public function getPrixBillet()
    {
        return $this->prixBillet;
    }
}

