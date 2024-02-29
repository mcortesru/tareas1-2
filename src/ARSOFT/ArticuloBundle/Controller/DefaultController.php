<?php

namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ARSOFTArticuloBundle:Default:index.html.twig', array('name' => $name));
    }
}
