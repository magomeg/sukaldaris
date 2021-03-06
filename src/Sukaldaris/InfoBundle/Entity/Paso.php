<?php
// src/Sukaldaris/InfoBundle/Entity/Paso.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
* @ORM\Entity
* @ORM\Table(name="paso")
* @ORM\Entity(repositoryClass="Sukaldaris\InfoBundle\Entity\PasoRepository")
*/

class Paso
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

    /**
    * @ORM\Column(type="integer")
    */
    protected $numeroPaso;

	/**
	* @ORM\Column(type="text")
	*/
	protected $texto;

    /**
     * @ORM\ManyToOne(targetEntity="Receta", inversedBy="pasos")
     * @ORM\JoinColumn(name="id_receta", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_receta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    

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
     * Set numeroPaso
     *
     * @param integer $numeroPaso
     * @return Paso
     */
    public function setNumeroPaso($numeroPaso)
    {
        $this->numeroPaso = $numeroPaso;

        return $this;
    }

    /**
     * Get numeroPaso
     *
     * @return integer 
     */
    public function getNumeroPaso()
    {
        return $this->numeroPaso;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Paso
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set id_receta
     *
     * @param \Sukaldaris\InfoBundle\Entity\Receta $idReceta
     * @return Paso
     */
    public function setIdReceta(\Sukaldaris\InfoBundle\Entity\Receta $idReceta = null)
    {
        $this->id_receta = $idReceta;

        return $this;
    }

    /**
     * Get id_receta
     *
     * @return \Sukaldaris\InfoBundle\Entity\Receta 
     */
    public function getIdReceta()
    {
        return $this->id_receta;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Paso
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
}
