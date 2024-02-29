<?php

namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowArticuloController extends Controller
{
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

        // Verificar si el artículo fue encontrado
        if (!$articulo) {
            throw $this->createNotFoundException('El artículo no existe');
        }

        return $this->render('ARSOFTArticuloBundle:Articulos:show.html.twig', array('articulo' => $articulo));
    }
}
