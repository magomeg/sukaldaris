<?php
// src/Sukaldaris/InfoBundle/Entity/Utensilio.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="utensilio")
*/

class Utensilio
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
     * @ORM\ManyToMany(targetEntity="Receta", inversedBy="utensilios")
     * @ORM\JoinTable(name="utensilios_recetas",
     *      joinColumns={@ORM\JoinColumn(name="utensilio_id", referencedColumnName="id")},
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
     * Set nombre
     *
     * @param string $nombre
     * @return Utensilio
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
}
