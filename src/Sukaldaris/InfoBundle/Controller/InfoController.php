<?php

namespace Sukaldaris\InfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfoController extends Controller
{
    public function indexAction()
    {
        return $this->render('SukaldarisInfoBundle:Info:index.html.twig');
    }
    public function exampleAction()
    {
    	$receta = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:Receta')->find(1);

		$palabras = $this->get('doctrine')->getManager()->getRepository('SukaldarisInfoBundle:PalabraClave')->getPalabrasClaveForReceta(1);

        return $this->render('SukaldarisInfoBundle:Info:receta.html.twig', array('receta' => $receta, 'palabras' => $palabras));
    }
}
