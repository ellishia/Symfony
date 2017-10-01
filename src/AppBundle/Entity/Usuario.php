<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 * @ORM\Table(name="usuario")
 * 
 */
class Usuario implements UserInterface, \Serializable
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
    private $nombre;

   /**
     * @ORM\Column(type="string")
     */
    private $apellidos;
    
     /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;


    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

     /**
     * @ORM\Column(type="string")
     */
    private $password;

   /**
     * @ORM\Column(type="datetime")
     */
    private $fechaalta;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastlogin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\Column(type="array", name="roles")
     */
    protected $roles;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fechaalta
     *
     * @param \DateTime $fechaalta
     * @return Usuario
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;

        return $this;
    }

    /**
     * Get fechaalta
     *
     * @return \DateTime 
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * Set lastlogin
     *
     * @param \DateTime $lastlogin
     * @return Usuario
     */
    public function setLastlogin($lastlogin)
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    /**
     * Get lastlogin
     *
     * @return \DateTime 
     */
    public function getLastlogin()
    {
        return $this->lastlogin;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Usuario
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
    
    public function setDefaults()
    {
        $this->isActive =  false;
        $this->fechaalta = $this->lastlogin = new \DateTime("now");
       
        return $this;
    }
     public function __construct()
    {
        
        $this->isActive = false;
         $this->fechaalta = $this->lastlogin = new \DateTime("now");
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }
    
       public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    
    
     /**
     * Get roles
     *
     **/
     public function getRoles()
    {
        if (empty($this->roles))
            {                  
        return array('ROLE_USER');
        } 
        return ($this->roles);
    }
    
    public function setRoles($roles){
        $this->roles = $roles;
    }

    public function addRole($role){
        
       $this->roles->add($role);
    }
    
    public function removeRole($role){
        $this->roles->removeElement($role);
    }
    
    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password
                   // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    
    
     public function getEncoderName()
    {
         $limit = new DateTime('2016-04-01 00:00:00');
        if ($limit > $this->fechaalta) {
            return 'harsh';
        }

        return null; // use the default encoder
    }
}
