<?php

namespace Sansthon\ProdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etapefille
 *
 * @ORM\Table(name="etapeFille")
 * @ORM\Entity(repositoryClass="Sansthon\ProdBundle\Entity\EtapefilleRepository")
 */
class Etapefille
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
     * @var \Etape
     *
     * @ORM\ManyToOne(targetEntity="Etape")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fille", referencedColumnName="id")
     * })
     */
    private $fille;

    /**
     * @var \Etape
     *
     * @ORM\ManyToOne(targetEntity="Etape")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mere", referencedColumnName="id")
     * })
     */
    private $mere;



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
     * Set fille
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $fille
     * @return Etapefille
     */
    public function setFille(\Sansthon\ProdBundle\Entity\Etape $fille = null)
    {
        $this->fille = $fille;
    
        return $this;
    }

    /**
     * Get fille
     *
     * @return \Sansthon\ProdBundle\Entity\Etape 
     */
    public function getFille()
    {
        return $this->fille;
    }

    /**
     * Set mere
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $mere
     * @return Etapefille
     */
    public function setMere(\Sansthon\ProdBundle\Entity\Etape $mere = null)
    {
        $this->mere = $mere;
    
        return $this;
    }

    /**
     * Get mere
     *
     * @return \Sansthon\ProdBundle\Entity\Etape 
     */
    public function getMere()
    {
        return $this->mere;
    }
    public function __toString(){
      return $this->getMere().">".$this->getFille();
    }
}
