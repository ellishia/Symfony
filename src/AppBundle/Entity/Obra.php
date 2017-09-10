<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="obra")
 */
class Obra
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $titulo;

     /**
     * @ORM\Column(type="datetime")
     */
    private $anyo;

    /**
     * @ORM\Column(type="string")
     */
    private $medidas;
    
     /**
     * @var \Artista
     *
     * @ORM\ManyToOne(targetEntity="Artista")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artista_id", referencedColumnName="id")
     * })
     */
    private $artista;
    
    /**
     * @ORM\ManyToOne(targetEntity="Model")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     *  })
     */
    private $model;
    
     /**
       * @ORM\ManyToOne(targetEntity="Art")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="art_id", referencedColumnName="id")
     * }))
     */
    private $tipo;
    
      /**
     * @ORM\Column(type="string")
     */
    private $foto;
    
    
    /**
     * * @ORM\OneToMany(targetEntity="Imagen", mappedBy="obra")
     */
    private $imagen;
    
      /**
     * @ORM\Column(type="string", columnDefinition="SET('Mixta', 'Oleo', 'Grafito', 'Aerografo', 'Rotulador', 'Rotring', 'Aguafuerte', 'Aguatinta', 'Manera negra')")
     */
    private $tecnica;
    
    
      /**
     * @ORM\Column(type="string", columnDefinition="SET('Marmol travertino', 'Madera', 'Piedra basáltica', 'terracota', 'Cristal de roca',
     * 'microcemento', 'acero', 'cerámica', 'barro', 'malla metálica', 'onix', 'cobre', 'pigmento')")
     */
    private $material;
    
    /**
     *
     * @ORM\Column(type="boolean")
     */
    private $coleccionPrivada;
    
    /**
     *
     * @ORM\Column(type="float")
     */
    private $precio;
    
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
     * Set titulo
     *
     * @param string $titulo
     * @return Obra
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
     * Set a�o
     *
     * @param \DateTime $anyo
     * @return Obra
     */
    public function setAnyo($anyo)
    {
        $this->anyo = $anyo;

        return $this;
    }

    /**
     * Get anyo
     *
     * @return \DateTime 
     */
    public function getAnyo()
    {
        return $this->anyo;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Obra
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
     * Set estilo
     *
     * @param string $estilo
     * @return Obra
     */
    public function setEstilo($estilo)
    {
        $this->estilo = $estilo;

        return $this;
    }

    /**
     * Get estilo
     *
     * @return string 
     */
    public function getEstilo()
    {
        return $this->estilo;
    }

    /**
     * Set material
     *
     * @param string $material
     * @return Obra
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return string 
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set artista
     *
     * @param \AppBundle\Entity\Artista $artista
     * @return Obra
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
     * Set medidas
     *
     * @param string $medidas
     * @return Obra
     */
    public function setMedidas($medidas)
    {
        $this->medidas = $medidas;

        return $this;
    }

    /**
     * Get medidas
     *
     * @return string 
     */
    public function getMedidas()
    {
        return $this->medidas;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Obra
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set tecnica
     *
     * @param string $tecnica
     * @return Obra
     */
    public function setTecnica($tecnica)
    {
        $this->tecnica = $tecnica;

        return $this;
    }

    /**
     * Get tecnica
     *
     * @return string 
     */
    public function getTecnica()
    {
        return $this->tecnica;
    }

    /**
     * Set colecionPrivada
     *
     * @param boolean $colecionPrivada
     * @return Obra
     */
    public function setColeccionPrivada($colecionPrivada)
    {
        $this->coleccionPrivada = $colecionPrivada;

        return $this;
    }

    /**
     * Get colecionPrivada
     *
     * @return boolean 
     */
    public function getColeccionPrivada()
    {
        return $this->coleccionPrivada;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Obra
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Add imagen
     *
     * @param \AppBundle\Entity\Imagen $imagen
     * @return Obra
     */
    public function addImagen(\AppBundle\Entity\Imagen $imagen)
    {
        $imagen->setObra($this);
        $this->imagen.add( $imagen);

        return $this;
    }

    /**
     * Remove imagen
     *
     * @param \AppBundle\Entity\Imagen $imagen
     */
    public function removeImagen(\AppBundle\Entity\Imagen $imagen)
    {
        $this->imagen->removeElement($imagen);
    }

    /**
     * Get imagen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set model
     *
     * @param \AppBundle\Entity\Model $model
     * @return Obra
     */
    public function setModel(\AppBundle\Entity\Model $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \AppBundle\Entity\Model 
     */
    public function getModel()
    {
        return $this->model;
    }
    
    
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Obra
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
     * @return Obra
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
          $this->imagen = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
