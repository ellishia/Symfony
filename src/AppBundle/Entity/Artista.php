<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="artista")
 */
 
class Artista
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
    private $foto;

    /**
     * @ORM\ManyToMany(targetEntity="Art")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="art", referencedColumnName="id")
     * })
     */
    private $art;
    
    
    /**
     * @ORM\Column(type="string")
     */
    private $nombreArtistico;
    

        /**
     * @var \Artista
     *
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * })
     */
    private $usuario;

      /**
     * @ORM\Column(type="boolean")
     */
    private $destacado;
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
     * Set foto
     *
     * @param string $foto
     * @return Artista
     */
    public function setFoto(UploadedFile $file = null)
    {
        $this->foto = $file;

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
    
    public function getAbsolutePath()
    {
        return null === $this->foto
            ? null
            : $this->getUploadRootDir().'/'.$this->fotod;
    }

    public function getWebPath()
    {
        return null === $this->foto
            ? null
            : $this->getUploadDir().'/'.$this->foto;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'images/'.$this->getUsuario()->getNombre().'_'.$this->getUsuario()->getApellidos();
    }

    public function upload()
{
    // the file property can be empty if the field is not required
        if (null === $this->getFoto()) {
        return;
    }

    // use the original file name here but you should
    // sanitize it at least to avoid any security issues

    // move takes the target directory and then the
    // target filename to move to
    $this->getFoto()->move(
        $this->getUploadRootDir(),
        $this->getFoto()->getClientOriginalName()
    );

    // set the path property to the filename where you've saved the file
    $this->foto = $this->getFoto()->getClientOriginalName();

    // clean up the file property as you won't need it anymore
   
}
    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Artista
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
     * Set nombreArtistico
     *
     * @param string $nombreArtistico
     * @return Artista
     */
    public function setNombreArtistico($nombreArtistico)
    {
        $this->nombreArtistico = $nombreArtistico;

        return $this;
    }

    /**
     * Get nombreArtistico
     *
     * @return string 
     */
    public function getNombreArtistico()
    {
        return $this->nombreArtistico;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     * @return Artista
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tipo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tipo
     *
     * @param \AppBundle\Entity\Art $tipo
     * @return Artista
     */
    public function addTipo(\AppBundle\Entity\Art $tipo)
    {
        $this->tipo[] = $tipo;

        return $this;
    }

    /**
     * Remove tipo
     *
     * @param \AppBundle\Entity\Art $tipo
     */
    public function removeTipo(\AppBundle\Entity\Art $tipo)
    {
        $this->tipo->removeElement($tipo);
    }

    /**
     * Set usuarioId
     *
     * @param \AppBundle\Entity\Usuario $usuarioId
     * @return Artista
     */
    public function setUsuarioId(\AppBundle\Entity\Usuario $usuarioId = null)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * Set destacado
     *
     * @param boolean $destacado
     * @return Artista
     */
    public function setDestacado($destacado)
    {
        $this->destacado = $destacado;

        return $this;
    }

    /**
     * Get destacado
     *
     * @return boolean 
     */
    public function getDestacado()
    {
        return $this->destacado;
    }

    /**
     * Add art
     *
     * @param \AppBundle\Entity\Art $art
     * @return Artista
     */
    public function addArt(\AppBundle\Entity\Art $art)
    {
        $this->art[] = $art;

        return $this;
    }

    /**
     * Remove art
     *
     * @param \AppBundle\Entity\Art $art
     */
    public function removeArt(\AppBundle\Entity\Art $art)
    {
        $this->art->removeElement($art);
    }

    /**
     * Get art
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArt()
    {
        return $this->art;
    }
}
