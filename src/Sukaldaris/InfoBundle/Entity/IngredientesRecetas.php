<?php
// src/Sukaldaris/InfoBundle/Entity/IngredientesRecetas.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="ingredientes_recetas")
*/

class IngredientesRecetas
{
	
    /**
    * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Receta", inversedBy="id")
     * @ORM\JoinColumn(name="id_receta", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_receta;

    /**
    * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Ingrediente", inversedBy="id")
     * @ORM\JoinColumn(name="id_ingrediente", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_ingrediente;
	
    /**
    * @ORM\Column(type="integer", nullable=true)
    */
    protected $cantidad;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id_receta = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id_ingrediente = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return IngredientesRecetas
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Add id_receta
     *
     * @param \Sukaldaris\InfoBundle\Entity\Receta $idReceta
     * @return IngredientesRecetas
     */
    public function addIdRecetum(\Sukaldaris\InfoBundle\Entity\Receta $idReceta)
    {
        $this->id_receta[] = $idReceta;

        return $this;
    }

    /**
     * Remove id_receta
     *
     * @param \Sukaldaris\InfoBundle\Entity\Receta $idReceta
     */
    public function removeIdRecetum(\Sukaldaris\InfoBundle\Entity\Receta $idReceta)
    {
        $this->id_receta->removeElement($idReceta);
    }

    /**
     * Get id_receta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdReceta()
    {
        return $this->id_receta;
    }

    /**
     * Add id_ingrediente
     *
     * @param \Sukaldaris\InfoBundle\Entity\Ingrediente $idIngrediente
     * @return IngredientesRecetas
     */
    public function addIdIngrediente(\Sukaldaris\InfoBundle\Entity\Ingrediente $idIngrediente)
    {
        $this->id_ingrediente[] = $idIngrediente;

        return $this;
    }

    /**
     * Remove id_ingrediente
     *
     * @param \Sukaldaris\InfoBundle\Entity\Ingrediente $idIngrediente
     */
    public function removeIdIngrediente(\Sukaldaris\InfoBundle\Entity\Ingrediente $idIngrediente)
    {
        $this->id_ingrediente->removeElement($idIngrediente);
    }

    /**
     * Get id_ingrediente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdIngrediente()
    {
        return $this->id_ingrediente;
    }

    /**
     * Set id_receta
     *
     * @param \Sukaldaris\InfoBundle\Entity\Receta $idReceta
     * @return IngredientesRecetas
     */
    public function setIdReceta(\Sukaldaris\InfoBundle\Entity\Receta $idReceta)
    {
        $this->id_receta = $idReceta;

        return $this;
    }

    /**
     * Set id_ingrediente
     *
     * @param \Sukaldaris\InfoBundle\Entity\Ingrediente $idIngrediente
     * @return IngredientesRecetas
     */
    public function setIdIngrediente(\Sukaldaris\InfoBundle\Entity\Ingrediente $idIngrediente)
    {
        $this->id_ingrediente = $idIngrediente;

        return $this;
    }
}
