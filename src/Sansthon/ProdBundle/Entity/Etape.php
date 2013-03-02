<?php

namespace Sansthon\ProdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Etape
 *
 * @ORM\Table(name="etape")
 * @ORM\Entity(repositoryClass="Sansthon\ProdBundle\Entity\EtapeRepository")
 */
class Etape
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
     * @ORM\Column(name="nom", type="string", length=15, nullable=true)
     */
    private $nom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="initiale", type="boolean", nullable=true)
     */
    private $initiale;

    /**
     * @var boolean
     *
     * @ORM\Column(name="finale", type="boolean", nullable=true)
     */
    private $finale;

    /**
     * @var boolean
     *
     * @ORM\Column(name="display_order", type="integer", nullable=true)
     */
    private $displayorder;


    /**
     * @ORM\ManyToMany(targetEntity="Etape", mappedBy="sorties")
     **/
    private $entrees;

    /**
     * @ORM\ManyToMany(targetEntity="Etape", inversedBy="entrees")
     * @ORM\JoinTable(name="chemin",
     *      joinColumns={@ORM\JoinColumn(name="entree_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="sortie_id", referencedColumnName="id")}
     *      )
     **/
     private $sorties;
    /*
    * constructeur
    *
    */
    public function __construct()
    {
        $this->filles = new ArrayCollection();
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
     * @return Etape
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
     * Set initiale
     *
     * @param boolean $initiale
     * @return Etape
     */
    public function setInitiale($initiale)
    {
        $this->initiale = $initiale;
    
        return $this;
    }

    /**
     * Get initiale
     *
     * @return boolean 
     */
    public function getInitiale()
    {
        return $this->initiale;
    }

    /**
     * Set final
     *
     * @param boolean $final
     * @return Etape
     */
    public function setFinal($final)
    {
        $this->final = $final;
    
        return $this;
    }

    /**
     * Get final
     *
     * @return boolean 
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * Set finale
     *
     * @param boolean $finale
     * @return Etape
     */
    public function setFinale($finale)
    {
        $this->finale = $finale;

        return $this;
    }

    /**
     * Get finale
     *
     * @return boolean 
     */
    public function getFinale()
    {
        return $this->finale;
    }
    public function __toString(){
      return $this->getNom();
    }

    /**
     * Set displayorder
     *
     * @param integer $displayorder
     * @return Etape
     */
    public function setDisplayorder($displayorder)
    {
        $this->displayorder = $displayorder;

        return $this;
    }

    /**
     * Get displayorder
     *
     * @return integer 
     */
    public function getDisplayorder()
    {
        return $this->displayorder;
    }

    /**
     * Add filles
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $filles
     * @return Etape
     */
    public function addFille(\Sansthon\ProdBundle\Entity\Etape $filles)
    {
        $this->filles[] = $filles;

        return $this;
    }

    /**
     * Remove filles
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $filles
     */
    public function removeFille(\Sansthon\ProdBundle\Entity\Etape $filles)
    {
        $this->filles->removeElement($filles);
    }

    /**
     * Get filles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilles()
    {
        return $this->filles;
    }

    /**
     * Add entree
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $entree
     * @return Etape
     */
    public function addEntree(\Sansthon\ProdBundle\Entity\Etape $entree)
    {
        $this->entree[] = $entree;

        return $this;
    }

    /**
     * Remove entree
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $entree
     */
    public function removeEntree(\Sansthon\ProdBundle\Entity\Etape $entree)
    {
        $this->entree->removeElement($entree);
    }

    /**
     * Get entree
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntree()
    {
        return $this->entree;
    }

    /**
     * Add sortie
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $sortie
     * @return Etape
     */
    public function addSortie(\Sansthon\ProdBundle\Entity\Etape $sortie)
    {
        $this->sortie[] = $sortie;

        return $this;
    }

    /**
     * Remove sortie
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $sortie
     */
    public function removeSortie(\Sansthon\ProdBundle\Entity\Etape $sortie)
    {
        $this->sortie->removeElement($sortie);
    }

    /**
     * Get sortie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSortie()
    {
        return $this->sortie;
    }

    /**
     * Get entrees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntrees()
    {
        return $this->entrees;
    }

    /**
     * Add sorties
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $sorties
     * @return Etape
     */
    public function addSorty(\Sansthon\ProdBundle\Entity\Etape $sorties)
    {
        $this->sorties[] = $sorties;

        return $this;
    }

    /**
     * Remove sorties
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $sorties
     */
    public function removeSorty(\Sansthon\ProdBundle\Entity\Etape $sorties)
    {
        $this->sorties->removeElement($sorties);
    }

    /**
     * Get sorties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSorties()
    {
        return $this->sorties;
    }
}
