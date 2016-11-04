<?php
// src/Sukaldaris/InfoBundle/Entity/Chef.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="chef")
* @ORM\Entity(repositoryClass="Sukaldaris\InfoBundle\Entity\ChefRepository")
*/

class Chef
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $nombre;

	/**
	* @ORM\Column(type="text")
	*/
	protected $apellidos;

	/**
	* @ORM\Column(type="text")
	*/
	protected $restaurante;
	
	/**
	* @ORM\Column(type="text")
	*/
	protected $info;

    /**
    * @ORM\OneToMany(targetEntity="Receta", mappedBy="id_chef")
    */
    protected $recetas;
	

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
     * @return Chef
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
     * @return Chef
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
     * Set restaurante
     *
     * @param string $restaurante
     * @return Chef
     */
    public function setRestaurante($restaurante)
    {
        $this->restaurante = $restaurante;

        return $this;
    }

    /**
     * Get restaurante
     *
     * @return string 
     */
    public function getRestaurante()
    {
        return $this->restaurante;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Chef
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recetas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add recetas
     *
     * @param \Sukaldaris\InfoBundle\Entity\Receta $recetas
     * @return Chef
     */
    public function addReceta(\Sukaldaris\InfoBundle\Entity\Receta $recetas)
    {
        $this->recetas[] = $recetas;

        return $this;
    }

    /**
     * Remove recetas
     *
     * @param \Sukaldaris\InfoBundle\Entity\Receta $recetas
     */
    public function removeReceta(\Sukaldaris\InfoBundle\Entity\Receta $recetas)
    {
        $this->recetas->removeElement($recetas);
    }

    /**
     * Get recetas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecetas()
    {
        return $this->recetas;
    }
}
