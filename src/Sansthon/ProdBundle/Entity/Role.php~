<?php

namespace Sansthon\ProdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="Sansthon\ProdBundle\Entity\RoleRepository")
 */
class Role
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity="Etape", inversedBy="roles")
     * @ORM\JoinTable(name="etapes_roles")
     */
    private $etapes;

    /**
     * @ORM\ManyToMany(targetEntity="Personne", inversedBy="roles")
     * @ORM\JoinTable(name="personnes_roles")
     */
    private $personnes;


    public function __construct() {
        $this->etapes = new ArrayCollection();
        $this->personnes = new ArrayCollection();
    }

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
     * Set nom
     *
     * @param string $nom
     * @return Role
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Role
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
    public function __toString(){
      return $this->getNom();
    }

    /**
     * Add etapes
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $etapes
     * @return Role
     */
    public function addEtape(\Sansthon\ProdBundle\Entity\Etape $etapes)
    {
        $this->etapes[] = $etapes;

        return $this;
    }

    /**
     * Remove etapes
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $etapes
     */
    public function removeEtape(\Sansthon\ProdBundle\Entity\Etape $etapes)
    {
        $this->etapes->removeElement($etapes);
    }

    /**
     * Get etapes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtapes()
    {
        return $this->etapes;
    }

    /**
     * Add personnes
     *
     * @param \Sansthon\ProdBundle\Entity\Personne $personnes
     * @return Role
     */
    public function addPersonne(\Sansthon\ProdBundle\Entity\Personne $personnes)
    {
        $this->personnes[] = $personnes;

        return $this;
    }

    /**
     * Remove personnes
     *
     * @param \Sansthon\ProdBundle\Entity\Personne $personnes
     */
    public function removePersonne(\Sansthon\ProdBundle\Entity\Personne $personnes)
    {
        $this->personnes->removeElement($personnes);
    }

    /**
     * Get personnes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonnes()
    {
        return $this->personnes;
    }
}
