<?php

namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticulosController extends Controller
{
    public function indexAction()
    {
        $articulos = [
            ['id' => 1, 'title' => 'Artículo 1', 'created' => '2024-02-01'],
            ['id' => 2, 'title' => 'Artículo 2', 'created' => '2024-02-02'],
            ['id' => 3, 'title' => 'Artículo 3', 'created' => '2024-02-03'],
        ];
        return $this->render('ARSOFTArticuloBundle:Articulos:index.html.twig', array('articulos' => $articulos));
    }    
}
