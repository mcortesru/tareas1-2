<?php
namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ARSOFT\ArticuloBundle\Entity\Articulo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\NotBlank;




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
        $articulo = new Articulo();
        $form = $this->createFormBuilder($articulo)
            ->add('titulo', 'text', array(
                'constraints' => new NotBlank()
            ))
            ->add('autor', 'text')
            ->add('contenido', 'textarea')
            ->add('categoria', 'text')
            ->add('creado', 'date', array(
                'widget' => 'single_text'
            ))
            ->add('guardar', 'submit', array('label' => 'Crear Artículo'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articulo);
            $em->flush();

            return $this->redirect($this->generateUrl('listar_articulos'));
        }

        return $this->render('ARSOFTArticuloBundle:MisVistas:crear_articulo.html.twig', array(
            'form' => $form->createView(),
        ));
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
