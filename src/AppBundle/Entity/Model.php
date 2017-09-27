<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\Table(name="model")
 */
class Model
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
    private $nombreArtistico;

     /**
     * @ORM\Column(type="string")
     */
    private $foto;

           /**
     * @var \Model
     *
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuarioId;


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
     * Set nombreArtistico
     *
     * @param string $nombreArtistico
     * @return Model
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
     * Set foto
     *
     * @param string $foto
     * @return Model
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
     
    public function getAbsolutePath()
    {
        return null === $this->foto
            ? null
            : $this->getUploadRootDir().'/'.$this->foto;
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
     * Set usuarioId
     *
     * @param \AppBundle\Entity\Usuario $usuario $usuario
     * @return Model
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * return \AppBundle\Entity\Usuario 
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }
    
}
