<?php
// src/Sukaldaris/InfoBundle/Entity/Ingrediente.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="ingrediente")
*/

class Ingrediente
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\OneToMany(targetEntity="IngredientesRecetas", mappedBy="id_receta")
	*/
	protected $id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $nombre;

    


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
     * @return Ingrediente
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
     * Constructor
     */
    public function __construct()
    {
        $this->subconcept = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subconcept
     *
     * @param \Sukaldaris\InfoBundle\Entity\Subconcept $subconcept
     * @return Ingrediente
     */
    public function addSubconcept(\Sukaldaris\InfoBundle\Entity\Subconcept $subconcept)
    {
        $this->subconcept[] = $subconcept;

        return $this;
    }

    /**
     * Remove subconcept
     *
     * @param \Sukaldaris\InfoBundle\Entity\Subconcept $subconcept
     */
    public function removeSubconcept(\Sukaldaris\InfoBundle\Entity\Subconcept $subconcept)
    {
        $this->subconcept->removeElement($subconcept);
    }

    /**
     * Get subconcept
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubconcept()
    {
        return $this->subconcept;
    }
}
