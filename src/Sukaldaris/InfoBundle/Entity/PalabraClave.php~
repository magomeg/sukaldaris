<?php
// src/Sukaldaris/InfoBundle/Entity/PalabraClave.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="palabraclave")
* @ORM\Entity(repositoryClass="Sukaldaris\InfoBundle\Entity\PalabraClaveRepository")
*/

class PalabraClave
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
	protected $palabra;

    /**
     * @ORM\ManyToMany(targetEntity="Receta", inversedBy="palabras")
     * @ORM\JoinTable(name="palabras_recetas",
     *      joinColumns={@ORM\JoinColumn(name="palabra_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="receta_id", referencedColumnName="id")}
     *      )
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
     * Set palabra
     *
     * @param string $palabra
     * @return PalabraClave
     */
    public function setPalabra($palabra)
    {
        $this->palabra = $palabra;

        return $this;
    }

    /**
     * Get palabra
     *
     * @return string 
     */
    public function getPalabra()
    {
        return $this->palabra;
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
     * @return PalabraClave
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
