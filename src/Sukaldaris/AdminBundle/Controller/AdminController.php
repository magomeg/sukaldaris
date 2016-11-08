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

use Doctrine\ORM\Tools\Pagination\Paginator;

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

            return $this->redirect($this->generateUrl('sukaldaris_receta', array('id' => $receta->getId())));
        }
        
        
    }

    public function listIngredientesEditAction($page)
    {

       $ingredientes = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Ingrediente')->getIngredientesAlphabeticallyOrdered($page);

       $totalItems = count($ingredientes);
        $pagesCount = ceil($totalItems / 20);

        $ruta = 'sukaldaris_admin_goto_edit_ingrediente';

       return $this->render('SukaldarisAdminBundle:Admin:listIngredientes.html.twig', array('ingredientes' => $ingredientes, 'current' => $page, 'paginas' => $pagesCount, 'ruta' => $ruta));
    }

    public function listIngredientesDeleteAction($page)
    {

       $ingredientes = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Ingrediente')->getIngredientesAlphabeticallyOrdered($page);

       $totalItems = count($ingredientes);
        $pagesCount = ceil($totalItems / 20);

        $ruta = 'sukaldaris_admin_delete_ingrediente';

       return $this->render('SukaldarisAdminBundle:Admin:listIngredientes.html.twig', array('ingredientes' => $ingredientes, 'current' => $page, 'paginas' => $pagesCount, 'ruta' => $ruta));
    }

    public function listRecetasEditAction($page)
    {

       $recetas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->getRecetasAlphabeticallyOrdered($page);

       $totalItems = count($recetas);
        $pagesCount = ceil($totalItems / 20);

        $ruta = 'sukaldaris_admin_goto_edit_receta';

       return $this->render('SukaldarisAdminBundle:Admin:listRecetas.html.twig', array('recetas' => $recetas, 'current' => $page, 'paginas' => $pagesCount, 'ruta' => $ruta));
    }

    public function listRecetasDeleteAction($page)
    {

       $recetas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->getRecetasAlphabeticallyOrdered($page);

       $totalItems = count($recetas);
        $pagesCount = ceil($totalItems / 20);

        $ruta = 'sukaldaris_admin_delete_receta';

       return $this->render('SukaldarisAdminBundle:Admin:listRecetas.html.twig', array('recetas' => $recetas, 'current' => $page, 'paginas' => $pagesCount, 'ruta' => $ruta));
    }

    public function gotoEditIngredienteAction ($id)
    {
          $ingrediente = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Ingrediente')->find($id);  
        $form   = $this->createForm(new IngredienteType(), $ingrediente);
        $ruta = 'hp_admin_edit_ingrediente';
        
        return $this->render('SukaldarisAdminBundle:Admin:editIngrediente.html.twig', array('ingrediente' => $ingrediente,'form'   => $form->createView(), 'ruta' => $ruta));
    }

    public function editIngredienteAction($id)
    {
        $ingrediente = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Ingrediente')->find($id);        
       $request = $this->getRequest();
        $form = $this->createForm(new IngredienteType(), $ingrediente);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            $em = $this->getDoctrine()->getManager();
            $em->persist($ingrediente);
            $em->flush();

                    
        }return $this->redirect($this->generateUrl('sukaldaris_admin_ingrediente', array('id' => $ingrediente->getId())));
    }

    public function gotoEditRecetaAction ($id)
    {
          $receta = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->find($id);  
        $form   = $this->createForm(new RecetaType(), $receta);
        $ruta = 'hp_admin_edit_receta';
        
        return $this->render('SukaldarisAdminBundle:Admin:editReceta.html.twig', array('receta' => $receta,'form'   => $form->createView(), 'ruta' => $ruta));
    }

    public function editRecetaAction($id)
    {
        $receta = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->find($id);        
       $request = $this->getRequest();
        $form = $this->createForm(new RecetaType(), $receta);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            $em = $this->getDoctrine()->getManager();
            $em->persist($receta);
            $em->flush();
        
        } return $this->redirect($this->generateUrl('sukaldaris_receta', array('id' => $receta->getId())));
    }

    public function deleteIngredienteAction ($id){
        $em = $this->getDoctrine()->getEntityManager();
        $ingrediente = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Ingrediente')->find($id); 
        $em->remove($ingrediente);
        $em->flush();

        return $this->redirect($this->generateUrl('sukaldaris_admin_homepage'));
    }

   
    public function deleteRecetaAction ($id){
        $em = $this->getDoctrine()->getEntityManager();
        $receta = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->find($id); 
        $em->remove($receta);
        $em->flush();

        return $this->redirect($this->generateUrl('sukaldaris_admin_homepage'));
    }
}
