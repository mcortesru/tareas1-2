<?php
namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ARSOFT\ArticuloBundle\Entity\Articulo;

class ArticuloController extends Controller
{
    public function listarArticulosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articulos = $em->getRepository('ARSOFTArticuloBundle:Articulo')->findAll();
    
        return $this->render('ARSOFTArticuloBundle:MisVistas:listar_articulos.html.twig', array(
            'articulos' => $articulos,
        ));
    }

    public function crearArticuloAction(Request $request)
    {
        $titulo = $request->query->get('titulo');
        $autor = $request->query->get('autor');
        $contenido = $request->query->get('contenido');
        $categoria = $request->query->get('categoria');

        $articulo = new Articulo();
        $articulo->setTitulo($titulo);
        $articulo->setAutor($autor);
        $articulo->setContenido($contenido);
        $articulo->setCategoria($categoria);
        $articulo->setCreado(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($articulo);
        $em->flush();

        return $this->redirect($this->generateUrl('listar_articulos'));
    }


    public function modificarTituloAction($id, $titulo_nuevo)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('ARSOFTArticuloBundle:Articulo')->find($id);

        if (!$articulo) {
            throw $this->createNotFoundException('No se encontró el artículo solicitado.');
        }

        $articulo->setTitulo($titulo_nuevo);
        $em->flush();

        return $this->redirect('/articulo/listar');
    }   

    
    

    public function eliminarArticuloAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('ARSOFTArticuloBundle:Articulo')->find($id);
    
        if (!$articulo) {
            throw $this->createNotFoundException('No se encontró el artículo solicitado.');
        }
    
        $em->remove($articulo);
        $em->flush();
    
        return $this->redirect('/articulo/listar');
    }
    

    public function visualizarArticuloAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('ARSOFTArticuloBundle:Articulo')->find($id);
    
        if (!$articulo) {
            throw $this->createNotFoundException('No se encontró el artículo solicitado.');
        }
    
        return $this->render('ARSOFTArticuloBundle:MisVistas:mostrar_articulo.html.twig', array(
            'articulo' => $articulo,
        ));
    }
    
}
