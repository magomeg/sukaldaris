<?php

namespace Basic\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BasicBlogBundle:Default:index.html.twig');
    }
}
