<?php

namespace Sukaldaris\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
        $peliculas = $this->get('doctrine')->getManager()->getRepository('HPInfoBundle:Pelicula')->getPeliculasForPersonaje($personaje->getId());
        return $this->render('HPInfoBundle:Info:personaje.html.twig', array('personaje' => $personaje, 'peliculas' => $peliculas));
    }
}
