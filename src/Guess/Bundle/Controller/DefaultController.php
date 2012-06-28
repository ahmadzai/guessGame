<?php

namespace Guess\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('GuessBundle:Default:index.html.twig', array('name' => $name));
    }
}
