<?php
// src/Sukaldaris/InfoBundle/Entity/Subconcept.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="subconcept")
*/

class Subconcept
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
	protected $subconcept;

	 /**
     * @ORM\ManyToOne(targetEntity="Concept", inversedBy="values")
     * @ORM\JoinColumn(name="id_concept", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_concept;

     /**
    * @ORM\OneToMany(targetEntity="Ingrediente", mappedBy="medida")
    */
    protected $ingredientes;

    


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
     * Set subconcept
     *
     * @param string $subconcept
     * @return Subconcept
     */
    public function setSubconcept($subconcept)
    {
        $this->subconcept = $subconcept;

        return $this;
    }

    /**
     * Get subconcept
     *
     * @return string 
     */
    public function getSubconcept()
    {
        return $this->subconcept;
    }

    /**
     * Set id_concept
     *
     * @param \Sukaldaris\InfoBundle\Entity\Concept $idConcept
     * @return Subconcept
     */
    public function setIdConcept(\Sukaldaris\InfoBundle\Entity\Concept $idConcept = null)
    {
        $this->id_concept = $idConcept;

        return $this;
    }

    /**
     * Get id_concept
     *
     * @return \Sukaldaris\InfoBundle\Entity\Concept 
     */
    public function getIdConcept()
    {
        return $this->id_concept;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredientes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ingredientes
     *
     * @param \Sukaldaris\InfoBundle\Entity\Ingrediente $ingredientes
     * @return Subconcept
     */
    public function addIngrediente(\Sukaldaris\InfoBundle\Entity\Ingrediente $ingredientes)
    {
        $this->ingredientes[] = $ingredientes;

        return $this;
    }

    /**
     * Remove ingredientes
     *
     * @param \Sukaldaris\InfoBundle\Entity\Ingrediente $ingredientes
     */
    public function removeIngrediente(\Sukaldaris\InfoBundle\Entity\Ingrediente $ingredientes)
    {
        $this->ingredientes->removeElement($ingredientes);
    }

    /**
     * Get ingredientes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIngredientes()
    {
        return $this->ingredientes;
    }
}
