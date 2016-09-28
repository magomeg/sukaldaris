<?php

namespace Sukaldaris\InfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfoController extends Controller
{
    public function indexAction()
    {
        return $this->render('SukaldarisInfoBundle:Info:index.html.twig');
    }
}
