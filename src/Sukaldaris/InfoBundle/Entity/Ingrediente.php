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
    * @ORM\Column(type="float")
    */
    protected $precio;

    /**
     * @ORM\ManyToOne(targetEntity="Subconcept", inversedBy="ingredientes")
     * @ORM\JoinColumn(name="medida", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $medida;

    


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
     * Set precio
     *
     * @param float $precio
     * @return Ingrediente
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
     * Set medida
     *
     * @param \Sukaldaris\InfoBundle\Entity\Subconcept $medida
     * @return Ingrediente
     */
    public function setMedida(\Sukaldaris\InfoBundle\Entity\Subconcept $medida = null)
    {
        $this->medida = $medida;

        return $this;
    }

    /**
     * Get medida
     *
     * @return \Sukaldaris\InfoBundle\Entity\Subconcept 
     */
    public function getMedida()
    {
        return $this->medida;
    }
}
