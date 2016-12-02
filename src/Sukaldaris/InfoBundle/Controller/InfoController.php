<?php

namespace Sukaldaris\InfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InfoController extends Controller
{
    public function indexAction()
    {
        $recetas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->getLatestRecetas();

        
        return $this->render('SukaldarisInfoBundle:Info:index.html.twig', array('recetas' => $recetas)); 
               
    }
   
    public function recetaAction($id)
    {
        $receta = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->find($id);

        $palabras = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:PalabraClave')->getPalabrasClaveForReceta($id);

        $utensilios = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Utensilio')->getUtensiliosForReceta($id);

        $tecnicas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Tecnica')->getTecnicasForReceta($id);

        $ingredientesRecetas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:IngredientesRecetas')->getIngredientesRecetaForReceta($id);

        $pasos = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Paso')->getPasosForReceta($id);

        return $this->render('SukaldarisInfoBundle:Info:receta.html.twig', array('receta' => $receta, 'palabras' => $palabras, 'utensilios' => $utensilios, 'tecnicas' => $tecnicas, 'ingredientesRecetas' => $ingredientesRecetas, 'pasos' => $pasos));
    }

    public function verTodoAction($page)
    {
        $recetas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->getRecetasAlphabeticallyOrdered($page);

        $form   = $this->createFormBuilder()
        ->add('ingrediente', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Ingrediente','property' => 'nombre','label' => 'Ingrediente', 'expanded' => false, 'required'=> false))
             ->add('tecnica', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Tecnica','property' => 'nombre','label' => 'Tecnica', 'expanded' => false, 'required'=> false))
             ->add('categoria', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Categoria','property' => 'categoria','label' => 'Categoria', 'expanded' => false, 'required'=> false))
             ->add('chef', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Chef','property' => 'nombre','label' => 'Chef', 'expanded' => false, 'required'=> false))
        
        ->getForm()->createView();

        $ruta = 'sukaldaris_admin_create_receta';

       $totalItems = count($recetas);
        $pagesCount = ceil($totalItems / 20);

       return $this->render('SukaldarisInfoBundle:Info:all.html.twig', array('recetas' => $recetas, 'current' => $page, 'paginas' => $pagesCount, 'form' => $form));
    }

    public function searchAction()
    {
        
        return $this->render('SukaldarisInfoBundle:Info:search.html.twig');
    }

    public function searchResultsAction($pattern)
    {
        
    }
}
