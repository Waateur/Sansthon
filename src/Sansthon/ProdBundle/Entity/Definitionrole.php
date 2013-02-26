<?php

namespace Sansthon\ProdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Definitionrole
 *
 * @ORM\Table(name="definitionRole")
 * @ORM\Entity(repositoryClass="Sansthon\ProdBundle\Entity\DefinitionroleRepository")
 */
class Definitionrole
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
     *   @ORM\JoinColumn(name="etape_id", referencedColumnName="id")
     * })
     */
    private $etape;

    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;



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
     * Set etape
     *
     * @param \Sansthon\ProdBundle\Entity\Etape $etape
     * @return Definitionrole
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
     * Set role
     *
     * @param \Sansthon\ProdBundle\Entity\Role $role
     * @return Definitionrole
     */
    public function setRole(\Sansthon\ProdBundle\Entity\Role $role = null)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return \Sansthon\ProdBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }
    public function __toString(){
      return $this->getRole().">".$this->getEtape();
    }
}
