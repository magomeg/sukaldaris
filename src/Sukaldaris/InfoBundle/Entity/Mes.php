<?php
// src/Sukaldaris/InfoBundle/Entity/Ingrediente.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="mes")
* @ORM\Entity(repositoryClass="Sukaldaris\InfoBundle\Entity\MesRepository")
*/

class Mes
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\ManyToMany(targetEntity="Ingrediente", mappedBy="temporada")
    * @ORM\JoinTable(name="temporadas",
    *      joinColumns={@ORM\JoinColumn(name="mes_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="ingrediente_id", referencedColumnName="id")}
    *      )
    */
	protected $id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $mes;




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
     * Set mes
     *
     * @param string $mes
     * @return Mes
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return string 
     */
    public function getMes()
    {
        return $this->mes;
    }
}
