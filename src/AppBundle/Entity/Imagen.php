<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Obra;

/**
 * /**
 * @ORM\Entity
 * @ORM\Table(name="imagen")
 */
class Imagen
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     
    
       /**
     * @ORM\ManyToOne(targetEntity="Obra", inversedBy="imagen")
     * @ORM\JoinColumn(name="obra", referencedColumnName="id")
     */
    private $obra;

  
      /**
     * @ORM\Column(type="string", length=100)
     */
    private $titulo;

      /**
     * @ORM\Column(type="string")
     */
    private $path;
    
       /**
     * @ORM\Column(type="boolean")
     */
    private $individual;
    
        /**
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
     * @return Exposicion
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Exposicion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Exposicion
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
    
     /**
     * Set path
     *
     * @param string $path
     * @return Imagen
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Exposicion
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set individual
     *
     * @param boolean $individual
     * @return Exposicion
     */
    public function setIndividual($individual)
    {
        $this->individual = $individual;

        return $this;
    }

    /**
     * Get individual
     *
     * @return boolean 
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    /**
     * Set artista
     *
     * @param \AppBundle\Entity\Artista $artista
     * @return Exposicion
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
     * Set arte
     *
     * @param \AppBundle\Entity\Art $arte
     * @return Exposicion
     */
    public function setArte(\AppBundle\Entity\Art $arte = null)
    {
        $this->arte = $arte;

        return $this;
    }

    /**
     * Get arte
     *
     * @return \AppBundle\Entity\Art 
     */
    public function getArte()
    {
        return $this->arte;
    }

    /**
     * Set curriculum
     *
     * @param \AppBundle\Entity\Curriculum $curriculum
     * @return Exposicion
     */
    public function setCurriculum(\AppBundle\Entity\Curriculum $curriculum = null)
    {
        $this->curriculum = $curriculum;

        return $this;
    }

    /**
     * Get curriculum
     *
     * @return \AppBundle\Entity\Curriculum 
     */
    public function getCurriculum()
    {
        return $this->curriculum;
    }

    /**
     * Set obra
     *
     * @param \AppBundle\Entity\Obra $obra
     * @return Imagen
     */
    public function setObra(\AppBundle\Entity\Obra $obra = null)
    {
        $this->obra = $obra;

        return $this;
    }

    /**
     * Get obra
     *
     * @return \AppBundle\Entity\Obra 
     */
    public function getObra()
    {
        return $this->obra;
    }
    
    
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Imagen
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
     * @return Exposicion
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
     * Set modified
     *
     * @param \DateTime $lastlogin
     * @return Exposicion
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
    
    
     public function __construct()
    {
        
        $this->isActive = false;
         $this->created = new \DateTime("now");
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }
}
