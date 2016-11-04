<?php
// src/Sukaldaris/InfoBundle/Entity/Concept.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="concept")
* @ORM\Entity(repositoryClass="Sukaldaris\InfoBundle\Entity\ConceptRepository")
*/

class Concept
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
	protected $concept;

	/**
    * @ORM\OneToMany(targetEntity="Subconcept", mappedBy="id_concept")
    */
	protected $values;

    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->values = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set concept
     *
     * @param string $concept
     * @return Concept
     */
    public function setConcept($concept)
    {
        $this->concept = $concept;

        return $this;
    }

    /**
     * Get concept
     *
     * @return string 
     */
    public function getConcept()
    {
        return $this->concept;
    }

    /**
     * Add values
     *
     * @param \Sukaldaris\InfoBundle\Entity\Subconcept $values
     * @return Concept
     */
    public function addValue(\Sukaldaris\InfoBundle\Entity\Subconcept $values)
    {
        $this->values[] = $values;

        return $this;
    }

    /**
     * Remove values
     *
     * @param \Sukaldaris\InfoBundle\Entity\Subconcept $values
     */
    public function removeValue(\Sukaldaris\InfoBundle\Entity\Subconcept $values)
    {
        $this->values->removeElement($values);
    }

    /**
     * Get values
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getValues()
    {
        return $this->values;
    }
}
