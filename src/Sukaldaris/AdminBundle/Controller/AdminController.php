<?php

namespace Sukaldaris\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sukaldaris\InfoBundle\Entity\Categoria;
use Sukaldaris\InfoBundle\Entity\Chef;
use Sukaldaris\InfoBundle\Entity\Concept;

use Sukaldaris\InfoBundle\Entity\Ingrediente;
use Sukaldaris\InfoBundle\Entity\IngredientesRecetas;
use Sukaldaris\InfoBundle\Entity\PalabraClave;
use Sukaldaris\InfoBundle\Entity\Paso;
use Sukaldaris\InfoBundle\Entity\Receta;
use Sukaldaris\InfoBundle\Entity\Subconcept;
use Sukaldaris\InfoBundle\Entity\Tecnica;
use Sukaldaris\InfoBundle\Entity\Utensilio;

use Sukaldaris\InfoBundle\Resources;
use Sukaldaris\InfoBundle\Form\CategoriaType;
use Sukaldaris\InfoBundle\Form\IngredienteType;
use Sukaldaris\InfoBundle\Form\RecetaType;

class AdminController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('SukaldarisAdminBundle:Admin:index.html.twig');
    }

    public function newIngredienteAction()
    {
        $ingrediente = new Ingrediente();
        $form   = $this->createForm(new IngredienteType(), $ingrediente);
        $ruta = 'sukaldaris_admin_create_ingrediente';

        return $this->render('SukaldarisAdminBundle:Admin:addIngrediente.html.twig', array('ingrediente' => $ingrediente,'form'   => $form->createView(), 'ruta' => $ruta));
    }
    public function newRecetaAction (){
        $receta = new Receta();
        $form   = $this->createForm(new RecetaType(), $receta);
        $ruta = 'sukaldaris_admin_create_receta';

        return $this->render('SukaldarisAdminBundle:Admin:addReceta.html.twig', array('receta' => $receta,'form'   => $form->createView(), 'ruta' => $ruta));
    }

     public function createIngredienteAction()
    {
        $ingrediente= new Ingrediente();
        $request = $this->getRequest();
        $form = $this->createForm(new IngredienteType(), $ingrediente);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            $em = $this->getDoctrine()->getManager();
            $em->persist($ingrediente);
            $em->flush();

        }
        
    }
     public function createRecetaAction()
    {
        $receta= new Receta();
        $request = $this->getRequest();
        $form = $this->createForm(new RecetaType(), $receta);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            $em = $this->getDoctrine()->getManager();
            $em->persist($receta);
            $em->flush();

        }
        
        return $this->forward('sukaldaris.info_controller:recetaAction', array('id'=>($receta->getId())));
    }
}
