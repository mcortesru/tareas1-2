<?php

namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ARSOFTArticuloBundle:Default:index.html.twig', array('name' => $name));
    }

    public function listar_articulosAction()
    {
        $articulos = [
            ['id' => 1, 'title' => 'Artículo 1', 'created' => '2024-02-01', 'image' => 'images/articulo1.jpg'],
            ['id' => 2, 'title' => 'Artículo 2', 'created' => '2024-02-02', 'image' => 'images/articulo2.jpg'],
            ['id' => 3, 'title' => 'Artículo 3', 'created' => '2024-02-03', 'image' => 'images/articulo3.jpg'],
        ];
        
        return $this->render('ARSOFTArticuloBundle:MisVistas:listar_articulos.html.twig', array('articulos' => $articulos));
    }

    public function mostrar_articuloAction($id)
    {
        $articulos = [
            ['id' => 1, 'title' => 'Artículo 1', 'created' => '2024-02-01', 'image' => 'images/articulo1.jpg'],
            ['id' => 2, 'title' => 'Artículo 2', 'created' => '2024-02-02', 'image' => 'images/articulo2.jpg'],
            ['id' => 3, 'title' => 'Artículo 3', 'created' => '2024-02-03', 'image' => 'images/articulo3.jpg'],
        ];
        

        // Simular la búsqueda de un artículo por ID
        $articulo = null;
        foreach ($articulos as $item) {
            if ($item['id'] == $id) {
                $articulo = $item;
                break;
            }
        }

        return $this->render('ARSOFTArticuloBundle:MisVistas:mostrar_articulo.html.twig', array('articulo' => $articulo));
    }
}
