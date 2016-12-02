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
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $form   = $this->createForm(IngredienteType::class, $ingrediente);
        $ruta = 'sukaldaris_admin_create_ingrediente';

        return $this->render('SukaldarisAdminBundle:Admin:addIngrediente.html.twig', array('ingrediente' => $ingrediente,'form'   => $form->createView(), 'ruta' => $ruta));
    }
    public function newRecetaAction (){
        $receta = new Receta();

        $form   = $this->createForm(RecetaType::class, $receta);

        $ruta = 'sukaldaris_admin_create_receta';

        return $this->render('SukaldarisAdminBundle:Admin:addReceta.html.twig', array('receta' => $receta,'form'   => $form->createView(), 'ruta' => $ruta));
    }
    public function newCategoriaAction()
    {
        $categoria = new Categoria();
        $form   = $this->createForm(CategoriaType::class, $categoria);
        $ruta = 'sukaldaris_admin_create_categoria';

        return $this->render('SukaldarisAdminBundle:Admin:addCategoria.html.twig', array('categoria' => $categoria,'form'   => $form->createView(), 'ruta' => $ruta));
    }

     public function createIngredienteAction()
    {
        $ingrediente= new Ingrediente();
        $request = $this->getRequest();
        $form = $this->createForm(IngredienteType::class, $ingrediente);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            $em = $this->getDoctrine()->getManager();
            $em->persist($ingrediente);
            $em->flush();

        }
        return $this->render('SukaldarisAdminBundle:Admin:ingrediente.html.twig', array('ingrediente' => $ingrediente));
    }
    public function createRecetaAction()
    {
        $receta= new Receta();
       
        $request = $this->getRequest();
        $form = $this->createForm(RecetaType::class, $receta);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            $file=$receta->getPath();
            if (is_null($file)){
                $fileName = 'base.png';
            }
            else{
                $fileName = $receta->getId().'.'.$file->guessExtension();
                   $file->move(
                    $this->getParameter('files_directory'),
                     $fileName
                     );
            }
            $receta->setPath($fileName);


            $em = $this->getDoctrine()->getManager();
            $em->persist($receta);
            $em->flush();

            
        }
        $id = $receta->getId();

        $palabras = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:PalabraClave')->getPalabrasClaveForReceta($id);

        $utensilios = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Utensilio')->getUtensiliosForReceta($id);

        $tecnicas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Tecnica')->getTecnicasForReceta($id);

        $ingredientesRecetas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:IngredientesRecetas')->getIngredientesRecetaForReceta($id);

        $pasos = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Paso')->getPasosForReceta($id);


        return $this->render('SukaldarisInfoBundle:Info:receta.html.twig', array('receta' => $receta, 'palabras' => $palabras, 'utensilios' => $utensilios, 'tecnicas' => $tecnicas, 'ingredientesRecetas' => $ingredientesRecetas, 'pasos' => $pasos));
        
        
    }
    public function createCategoriaAction()
    {
        $categoria= new Categoria();
        $request = $this->getRequest();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();

        }

        return $this->listCategoriasEditAction(1);
        
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
    public function listCategoriasEditAction($page)
    {

       $categorias = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Categoria')->getCategoriasAlphabeticallyOrdered($page);

       $totalItems = count($categorias);
        $pagesCount = ceil($totalItems / 20);

        $ruta = 'sukaldaris_admin_goto_edit_categoria';

       return $this->render('SukaldarisAdminBundle:Admin:listCategorias.html.twig', array('categorias' => $categorias, 'current' => $page, 'paginas' => $pagesCount, 'ruta' => $ruta));
    }

    public function listCategoriasDeleteAction($page)
    {

       $categorias = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Categoria')->getCategoriasAlphabeticallyOrdered($page);

       $totalItems = count($categorias);
        $pagesCount = ceil($totalItems / 20);

        $ruta = 'sukaldaris_admin_delete_categoria';

       return $this->render('SukaldarisAdminBundle:Admin:listCategorias.html.twig', array('categorias' => $categorias, 'current' => $page, 'paginas' => $pagesCount, 'ruta' => $ruta));
    }

    public function gotoEditIngredienteAction ($id)
    {
          $ingrediente = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Ingrediente')->find($id);  
        $form   = $this->createForm(IngredienteType::class, $ingrediente);
        $ruta = 'sukaldaris_admin_edit_ingrediente';
        
        return $this->render('SukaldarisAdminBundle:Admin:editIngrediente.html.twig', array('ingrediente' => $ingrediente,'form'   => $form->createView(), 'ruta' => $ruta));
    }

    public function editIngredienteAction($id)
    {
        $ingrediente = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Ingrediente')->find($id);        
       $request = $this->getRequest();
        $form = $this->createForm(IngredienteType::class, $ingrediente);
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
        $form   = $this->createForm(RecetaType::class, $receta);
        $ruta = 'sukaldaris_admin_edit_receta';
        
        return $this->render('SukaldarisAdminBundle:Admin:editReceta.html.twig', array('receta' => $receta,'form'   => $form->createView(), 'ruta' => $ruta));
    }

    public function editRecetaAction($id)
    {
        $receta = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->find($id);        
       $request = $this->getRequest();
        $form = $this->createForm(RecetaType::class, $receta);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity
            $file=$receta->getPath();
            if (is_null($file)){
                $fileName = 'base.png';
            }
            else{
                $fileName = $receta->getId().'.'.$file->guessExtension();
                   $file->move(
                    $this->getParameter('files_directory'),
                     $fileName
                     );
            }
           

                $receta->setPath($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($receta);
            $em->flush();

            
        
        } return $this->redirect($this->generateUrl('sukaldaris_receta', array('id' => $receta->getId())));
    }

    public function gotoEditCategoriaAction ($id)
    {
          $categoria = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Categoria')->find($id);  
        $form   = $this->createForm(CategoriaType::class, $categoria);
        $ruta = 'sukaldaris_admin_edit_categoria';
        
        return $this->render('SukaldarisAdminBundle:Admin:editCategoria.html.twig', array('categoria' => $categoria,'form'   => $form->createView(), 'ruta' => $ruta));
    }

    public function editCategoriaAction($id)
    {
        $categoria = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Categoria')->find($id);        
       $request = $this->getRequest();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->bind($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();

                    
        }return $this->redirect($this->generateUrl('sukaldaris_admin_categoria', array('id' => $categoria->getId())));
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

     public function deleteCategoriaAction ($id){
        $em = $this->getDoctrine()->getEntityManager();
        $categoria = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Categoria')->find($id); 
        $em->remove($categoria);
        $em->flush();

        return $this->redirect($this->generateUrl('sukaldaris_admin_homepage'));
    }

    /*JSON actions*/

    public function palabrasJSONAction($value='')
    {
        $palabras = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Palabra')->getAllPalabrasClave();

        $palabrasArray = $palabras->toArray();
        $json = json_encode($palabrasArray);

        $response = new JsonResponse();
        $response->setData($json);

        return $response;
    }

    public function palabrasSelectAction(Request $request)
    {
        $q = $request->get('q');
        $pageLimit = $request->get('page_limit');

        if (!is_numeric($pageLimit) || $pageLimit > 10) {
            $pageLimit = 10;
        }

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $result = $em->createQuery(
            'SELECT c.id, c.palabra as text FROM InfoBundle:PalabraClave c
            WHERE lower(c.palabra) LIKE :q
            ORDER BY c.palabra')
            ->setParameter('q', '%' . $q . '%')
            ->setMaxResults($pageLimit)
            ->getArrayResult();

        return new JsonResponse($result);
    }
}
