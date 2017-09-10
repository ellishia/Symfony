<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Estudio;
use AppBundle\Entity\Exposicion;

/**
 * /**
 * @ORM\Entity
 * @ORM\Table(name="curriculum")
 */
class Curriculum
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

       /**
     * @var \Artista
     *  @ORM\OneToOne(targetEntity="Artista")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="artista", referencedColumnName="id")
    *
     * })
     */
    private $artista;

  

      /**
     * @ORM\Column(type="string")
     */
    private $texto;
    
        /**
     * @var \Estudio
      @ORM\OneToMany(targetEntity="Estudio", mappedBy="curriculum", cascade={"persist"})
     */
    private $estudio;
    
      /**
       * @ORM\OneToMany(targetEntity="Exposicion", mappedBy="curriculum", cascade={"persist"})
     */
    private $exposicion;
    
    
        /**
         * @var \IsActive
     * @ORM\Column(type="boolean")
     */
    private $isActive;
    
     /**
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    
    private $createdBy;
     /**
     * @ORM\Column(type="datetime")
     */
    private $modified;
    
    
    public function __construct() {
        $this->estudio = new ArrayCollection();
        $this->exposicion = new ArrayCollection();
        
        $this->isActive = false;
        $this->created = new \DateTime("now");
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
     * Set artistaId
     *
     * @param integer $artistaId
     * @return Curriculum
     */
    public function setArtistaId($artistaId)
    {
        $this->artistaId = $artistaId;

        return $this;
    }

    /**
     * Get artistaId
     *
     * @return integer 
     */
    public function getArtistaId()
    {
        return $this->artistaId;
    }

  
      /**
     * Set artista
     *
     * @param \AppBundle\Entity\Artista $artista
     * @return Curriculum
     */
    public function setArtista(\AppBundle\Entity\Artista $artista = null)
    {
        $this->artista = $artista;

        return $this;
    }

    /**
     * Get artista
     *
     * @return \AppBundle\Entity\Artista 
     */
    public function getArtista()
    {
        return $this->artista;
    }


    /**
     * Set texto
     *
     * @param string $texto
     * @return Curriculum
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set estudio
     *
     * @param \AppBundle\Entity\Estudio $estudio
     * @return Curriculum
     */
    public function setEstudio(\AppBundle\Entity\Estudio $estudio = null)
    {
        $this->estudio = $estudio;

        return $this;
    }

    /**
     * Get estudio
     *
     * @return \AppBundle\Entity\Estudio 
     */
    public function getEstudio()
    {
        return $this->estudio;
    }

    /**
     * Set exposicion
     *
     * @param \AppBundle\Entity\Exposicion $exposicion
     * @return Curriculum
     */
    public function setExposicion(\AppBundle\Entity\Exposicion $exposicion = null)
    {
        $this->exposicion = $exposicion;

        return $this;
    }

    /**
     * Get exposicion
     *
     * @return \AppBundle\Entity\Exposicion 
     */
    public function getExposicion()
    {
        return $this->exposicion;
    }

    /**
     * Add estudio
     *
     * @param \AppBundle\Entity\Estudio $estudio
     * @return Curriculum
     */
    public function addEstudio(\AppBundle\Entity\Estudio $estudio)
    {
        $estudio->setCurriculum($this);
        
        $this->estudio->add($estudio);

        return $this;
    }

    /**
     * Remove estudio
     *
     * @param \AppBundle\Entity\Estudio $estudio
     */
    public function removeEstudio(\AppBundle\Entity\Estudio $estudio)
    {
        $this->estudio->removeElement($estudio);
    }

    /**
     * Add exposicion
     *
     * @param \AppBundle\Entity\Exposicion $exposicion
     * @return Curriculum
     */
    public function addExposicion(\AppBundle\Entity\Exposicion $exposicion)
    {
        $exposicion->setCurriculum($this);
        
        $this->exposicion->add($exposicion);

        return $this;
    }

    /**
     * Remove exposicion
     *
     * @param \AppBundle\Entity\Exposicion $exposicion
     */
    public function removeExposicion(\AppBundle\Entity\Exposicion $exposicion)
    {
        $this->exposicion->removeElement($exposicion);
    }
    
    
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Curriculum
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    
    /**
     * Set created
     *
     * @param \DateTime $lastlogin
     * @return Curriculum
     */
    public function setCreated($lastlogin)
    {
        $this->created = $lastlogin;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
    
    /**
     * Set created
     *
     * @param \DateTime $lastlogin
     * @return Curriculum
     */
    public function setModified($lastlogin)
    {
        $this->modified = $lastlogin;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }
    
}
  
    
