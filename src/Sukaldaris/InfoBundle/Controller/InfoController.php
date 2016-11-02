<?php

namespace Sukaldaris\InfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfoController extends Controller
{
    public function indexAction()
    {
        $recetas = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->getLatestRecetas();

        if (!$recetas) {
            exampleAction();
        }
        else{
           return $this->render('SukaldarisInfoBundle:Info:index.html.twig', array('recetas' => $recetas)); 
        }

        
    }
   
    public function recetaAction($id)
    {
        $receta = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->find($id);

        $palabras = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:PalabraClave')->getPalabrasClaveForReceta($id);

        return $this->render('SukaldarisInfoBundle:Info:receta.html.twig', array('receta' => $receta, 'palabras' => $palabras));
    }
}
