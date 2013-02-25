<?php

namespace Sansthon\ProdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perte
 *
 * @ORM\Table(name="perte")
 * @ORM\Entity(repositoryClass="Sansthon\ProdBundle\Entity\PerteRepository")
 */
class Perte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var \Etape
     *
     * @ORM\ManyToOne(targetEntity="Etape")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etape_id", referencedColumnName="id")
     * })
     */
    private $etape;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="personne_id", referencedColumnName="id")
     * })
     */
    private $personne;

    /**
     * @var \Type
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

     /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text",nullable=true)
     */
    private $commentaire;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Perte
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return Perte
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Perte
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    
        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set etape
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $etape
     * @return Perte
     */
    public function setEtape(\Sansthon\ProdBundle\Entity\Etape $etape = null)
    {
        $this->etape = $etape;
    
        return $this;
    }

    /**
     * Get etape
     *
     * @return \Sansthon\ProdBundle\Entity\Etape 
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set personne
     *
     * @param \Sansthon\ProdBundle\Entity\Personne $personne
     * @return Perte
     */
    public function setPersonne(\Sansthon\ProdBundle\Entity\Personne $personne = null)
    {
        $this->personne = $personne;
    
        return $this;
    }

    /**
     * Get personne
     *
     * @return \Sansthon\ProdBundle\Entity\Personne 
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set type
     *
     * @param \Sansthon\ProdBundle\Entity\Type $type
     * @return Perte
     */
    public function setType(\Sansthon\ProdBundle\Entity\Type $type = null)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return \Sansthon\ProdBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }
}
