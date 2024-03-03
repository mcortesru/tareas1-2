<?php

namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ARSOFTArticuloBundle:Default:index.html.twig', array('name' => $name));
    }

    public function listarArticulosAction()
    {
        $articulos = [
            ['id' => 1, 'title' => 'Artículo 1', 'created' => '2024-02-01'],
            ['id' => 2, 'title' => 'Artículo 2', 'created' => '2024-02-02'],
            ['id' => 3, 'title' => 'Artículo 3', 'created' => '2024-02-03'],
        ];
        return $this->render('ARSOFTArticuloBundle:MisVistas:listarArticulos.html.twig', array('articulos' => $articulos));
    }

    public function showAction($id)
    {
        $articulos = [
            ['id' => 1, 'title' => 'Artículo 1', 'created' => '2024-02-01'],
            ['id' => 2, 'title' => 'Artículo 2', 'created' => '2024-02-02'],
            ['id' => 3, 'title' => 'Artículo 3', 'created' => '2024-02-03'],
        ];

        // Simular la búsqueda de un artículo por ID
        $articulo = null;
        foreach ($articulos as $item) {
            if ($item['id'] == $id) {
                $articulo = $item;
                break;
            }
        }

        return $this->render('ARSOFTArticuloBundle:MisVistas:show.html.twig', array('articulo' => $articulo));
    }
}
