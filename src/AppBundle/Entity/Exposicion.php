<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Curriculum;

/**
 * /**
 * @ORM\Entity
 * @ORM\Table(name="exposicion")
 */
class Exposicion
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

       /**
     * @var \Artista
     *
     * @ORM\ManyToOne(targetEntity="Artista")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artista", referencedColumnName="id")
     * })
     */
    private $artista;
    
       /**
     * @ORM\ManyToOne(targetEntity="Curriculum", inversedBy="exposicion")
     * @ORM\JoinColumn(name="curriculum", referencedColumnName="id")
     */
    private $curriculum;

     /** @ORM\Column(type="string", columnDefinition="ENUM('Exposicion', 'Trabajo', 'Decoracion', 'Diseño', 'Escenografia')")  **/
    private $tipo;

     /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

      /**
     * @ORM\Column(type="string", length=100)
     */
    private $titulo;

     /**
     * @ORM\Column(type="string", length=100)
     */
    private $lugar;

       /**
     * @ORM\Column(type="boolean")
     */
    protected $individual = false;
    
    /**
       * @ORM\ManyToMany(targetEntity="Art")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="art_id", referencedColumnName="id")
     * })
     */
    private $arte;
  
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
/**
     * Add art
     *
     * @param \AppBundle\Entity\Art $art
     * @return Exposicion
     */
    public function addArte(\AppBundle\Entity\Art $art)
    {
        $this->arte[] = $art;

        return $this;
    }

    /**
     * Remove art
     *
     * @param \AppBundle\Entity\Art $art
     */
    public function removeArte(\AppBundle\Entity\Art $art)
    {
        $this->arte->removeElement($art);
    }

    /**
     * Get art
     *
     * @return \Doctrine\Common\Collections\Collection 
   **/
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
     * Set tipo
     *
     * @param string $tipo
     * @return Exposicion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
    
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Exposicion
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
