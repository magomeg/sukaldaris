<?php
// src/Sukaldaris/InfoBundle/Entity/Receta.php
namespace Sukaldaris\InfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
* @ORM\Entity
* @ORM\Table(name="receta")
* @ORM\Entity(repositoryClass="Sukaldaris\InfoBundle\Entity\RecetaRepository")
*/

class Receta
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
	protected $titulo;

	/**
    * @ORM\Column(type="date")
    */
    protected $fecha_publicacion;

    /**
    * @ORM\Column(type="integer", nullable=true)
    */
    protected $dificultad;

    /**
    * @ORM\Column(type="integer", nullable=true)
    */
    protected $tiempo_cocinado;

    /**
    * @ORM\Column(type="integer", nullable=true)
    */
    protected $tiempo_preparacion;

    /**
    * @ORM\Column(type="integer", nullable=true)
    */
    protected $personas;

    /**
     * @ORM\ManyToOne(targetEntity="Chef", inversedBy="recetas")
     * @ORM\JoinColumn(name="id_chef", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_chef;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="recetas")
     * @ORM\JoinColumn(name="id_categoria", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_categoria;

     /**
     * @ORM\ManyToMany(targetEntity="PalabraClave", mappedBy="recetas")
    * @ORM\JoinTable(name="palabras_recetas",
     *      joinColumns={@ORM\JoinColumn(name="receta_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="palabra_id", referencedColumnName="id")}
     *      )
     */
    protected $palabras;

     /**
     * @ORM\ManyToMany(targetEntity="Tecnica", mappedBy="recetas")
    * @ORM\JoinTable(name="tecnicas_recetas",
     *      joinColumns={@ORM\JoinColumn(name="receta_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tecnica_id", referencedColumnName="id")}
     *      )
     */
    protected $tecnicas;

     /**
     * @ORM\ManyToMany(targetEntity="Utensilio", mappedBy="recetas")
    * @ORM\JoinTable(name="utensilios_recetas",
     *      joinColumns={@ORM\JoinColumn(name="receta_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="utensilio_id", referencedColumnName="id")}
     *      )
     */
    protected $utensilios;

    /**
    * @ORM\OneToMany(targetEntity="Paso", mappedBy="id_receta")
    */
    protected $pasos;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->palabras = new \Doctrine\Common\Collections\ArrayCollection();

        $this->fecha_publicacion = new \DateTime();
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
     * Set titulo
     *
     * @param string $titulo
     * @return Receta
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set fecha_publicacion
     *
     * @param \DateTime $fechaPublicacion
     * @return Receta
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fecha_publicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fecha_publicacion
     *
     * @return \DateTime 
     */
    public function getFechaPublicacion()
    {
        return $this->fecha_publicacion;
    }

    /**
     * Set dificultad
     *
     * @param integer $dificultad
     * @return Receta
     */
    public function setDificultad($dificultad)
    {
        $this->dificultad = $dificultad;

        return $this;
    }

    /**
     * Get dificultad
     *
     * @return integer 
     */
    public function getDificultad()
    {
        return $this->dificultad;
    }

    /**
     * Set tiempo_cocinado
     *
     * @param integer $tiempoCocinado
     * @return Receta
     */
    public function setTiempoCocinado($tiempoCocinado)
    {
        $this->tiempo_cocinado = $tiempoCocinado;

        return $this;
    }

    /**
     * Get tiempo_cocinado
     *
     * @return integer 
     */
    public function getTiempoCocinado()
    {
        return $this->tiempo_cocinado;
    }

    /**
     * Set tiempo_preparacion
     *
     * @param integer $tiempoPreparacion
     * @return Receta
     */
    public function setTiempoPreparacion($tiempoPreparacion)
    {
        $this->tiempo_preparacion = $tiempoPreparacion;

        return $this;
    }

    /**
     * Get tiempo_preparacion
     *
     * @return integer 
     */
    public function getTiempoPreparacion()
    {
        return $this->tiempo_preparacion;
    }

    /**
     * Set personas
     *
     * @param integer $personas
     * @return Receta
     */
    public function setPersonas($personas)
    {
        $this->personas = $personas;

        return $this;
    }

    /**
     * Get personas
     *
     * @return integer 
     */
    public function getPersonas()
    {
        return $this->personas;
    }

    /**
     * Set id_chef
     *
     * @param \Sukaldaris\InfoBundle\Entity\Chef $idChef
     * @return Receta
     */
    public function setIdChef(\Sukaldaris\InfoBundle\Entity\Chef $idChef = null)
    {
        $this->id_chef = $idChef;

        return $this;
    }

    /**
     * Get id_chef
     *
     * @return \Sukaldaris\InfoBundle\Entity\Chef 
     */
    public function getIdChef()
    {
        return $this->id_chef;
    }

    /**
     * Add palabras
     *
     * @param \Sukaldaris\InfoBundle\Entity\PalabraClave $palabras
     * @return Receta
     */
    public function addPalabra(\Sukaldaris\InfoBundle\Entity\PalabraClave $palabras)
    {
        $this->palabras[] = $palabras;

        return $this;
    }

    /**
     * Remove palabras
     *
     * @param \Sukaldaris\InfoBundle\Entity\PalabraClave $palabras
     */
    public function removePalabra(\Sukaldaris\InfoBundle\Entity\PalabraClave $palabras)
    {
        $this->palabras->removeElement($palabras);
    }

    /**
     * Get palabras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPalabras()
    {
        return $this->palabras;
    }

    /**
     * Add pasos
     *
     * @param \Sukaldaris\InfoBundle\Entity\Paso $pasos
     * @return Receta
     */
    public function addPaso(\Sukaldaris\InfoBundle\Entity\Paso $pasos)
    {
        $this->pasos[] = $pasos;

        return $this;
    }

    /**
     * Remove pasos
     *
     * @param \Sukaldaris\InfoBundle\Entity\Paso $pasos
     */
    public function removePaso(\Sukaldaris\InfoBundle\Entity\Paso $pasos)
    {
        $this->pasos->removeElement($pasos);
    }

    /**
     * Get pasos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPasos()
    {
        return $this->pasos;
    }

    /**
     * Set id_categoria
     *
     * @param \Sukaldaris\InfoBundle\Entity\Categoria $idCategoria
     * @return Receta
     */
    public function setIdCategoria(\Sukaldaris\InfoBundle\Entity\Categoria $idCategoria = null)
    {
        $this->id_categoria = $idCategoria;

        return $this;
    }

    /**
     * Get id_categoria
     *
     * @return \Sukaldaris\InfoBundle\Entity\Categoria 
     */
    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    /**
     * Add tecnicas
     *
     * @param \Sukaldaris\InfoBundle\Entity\Tecnica $tecnicas
     * @return Receta
     */
    public function addTecnica(\Sukaldaris\InfoBundle\Entity\Tecnica $tecnicas)
    {
        $this->tecnicas[] = $tecnicas;

        return $this;
    }

    /**
     * Remove tecnicas
     *
     * @param \Sukaldaris\InfoBundle\Entity\Tecnica $tecnicas
     */
    public function removeTecnica(\Sukaldaris\InfoBundle\Entity\Tecnica $tecnicas)
    {
        $this->tecnicas->removeElement($tecnicas);
    }

    /**
     * Get tecnicas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTecnicas()
    {
        return $this->tecnicas;
    }

    /**
     * Add utensilios
     *
     * @param \Sukaldaris\InfoBundle\Entity\Utensilio $utensilios
     * @return Receta
     */
    public function addUtensilio(\Sukaldaris\InfoBundle\Entity\Utensilio $utensilios)
    {
        $this->utensilios[] = $utensilios;

        return $this;
    }

    /**
     * Remove utensilios
     *
     * @param \Sukaldaris\InfoBundle\Entity\Utensilio $utensilios
     */
    public function removeUtensilio(\Sukaldaris\InfoBundle\Entity\Utensilio $utensilios)
    {
        $this->utensilios->removeElement($utensilios);
    }

    /**
     * Get utensilios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUtensilios()
    {
        return $this->utensilios;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Receta
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
