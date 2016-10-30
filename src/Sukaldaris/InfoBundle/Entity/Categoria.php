<?php
// src/Sukaldaris/InfoBundle/Entity/Categoria.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="categoria")
*/

class Categoria
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
	protected $categoria;

	/**
    * @ORM\OneToMany(targetEntity="Receta", mappedBy="id_categoria")
    */
    protected $recetas;
	

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recetas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set categoria
     *
     * @param string $categoria
     * @return Categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add recetas
     *
     * @param \Sukaldaris\InfoBundle\Entity\Receta $recetas
     * @return Categoria
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
