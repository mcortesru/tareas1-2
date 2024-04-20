<?php
namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ARSOFT\ArticuloBundle\Entity\Articulo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ARSOFT\ArticuloBundle\Form\ArticuloType;



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

    public function modificarTituloAction($id, $titulo_nuevo)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('ARSOFTArticuloBundle:Articulo')->find($id);

        if (!$articulo) {
            throw $this->createNotFoundException('No se encontró el artículo solicitado.');
        }

        $articulo->setTitulo($titulo_nuevo);
        $em->flush();

        return $this->redirect('/articulos');
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
    
        return $this->redirect('/articulos');
    }
    
    public function visualizarArticuloAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('ARSOFTArticuloBundle:Articulo')->find($id);
    
        if (!$articulo) {
            throw $this->createNotFoundException('No se encontró el artículo solicitado.');
        }
    
        $comentarios = $em->getRepository('ARSOFTArticuloBundle:Comentario')->findBy(['articulo' => $articulo]);
            
        return $this->render('ARSOFTArticuloBundle:MisVistas:mostrar_articulo.html.twig', array(
            'articulo' => $articulo,
            'comentarios' => $comentarios
        ));
    }
    

    public function crearArticuloSinTypeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = new Articulo();
        
        $form = $this->createFormBuilder($articulo)
            ->add('titulo', 'text')
            ->add('autor', 'text')
            ->add('contenido', 'textarea')
            ->add('categoria', 'text')
            ->add('creado', 'date')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($articulo);
            $em->flush();

            return $this->redirect($this->generateUrl('mostrar_articulo', array('id' => $articulo->getId())));
        }

        return $this->render('ARSOFTArticuloBundle:MisVistas:crear_articulo_sin_type.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function crearArticuloConTypeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = new Articulo();

        // Crear un formulario para el artículo utilizando un 'ArticuloType' personalizado
        $form = $this->createForm(new ArticuloType());


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($articulo);
            $em->flush();

            // Redirigir a una página que muestra el artículo
            return $this->redirect($this->generateUrl('ver_articulo', ['id' => $articulo->getId()]));
        }

        // Renderizar la vista del formulario
        return $this->render('ARSOFTArticuloBundle:MisVistas:crear_articulo_con_type.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
