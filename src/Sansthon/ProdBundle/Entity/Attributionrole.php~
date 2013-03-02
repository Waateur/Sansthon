<?php

namespace Sansthon\ProdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attributionrole
 *
 * @ORM\Table(name="attributionRole")
 * @ORM\Entity(repositoryClass="Sansthon\ProdBundle\Entity\AttributionroleRepository")
 */
class Attributionrole
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
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="personne_id", referencedColumnName="id")
     * })
     */
    private $personne;

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
     * Set personne
     *
     * @param \Sansthon\ProdBundle\Entity\Personne $personne
     * @return Attributionrole
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
     * Set role
     *
     * @param \Sansthon\ProdBundle\Entity\Role $role
     * @return Attributionrole
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
      return $this->getRole().">".$this->getPersonne();
    }
}
