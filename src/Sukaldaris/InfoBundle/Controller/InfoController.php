<?php

namespace Sukaldaris\InfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
