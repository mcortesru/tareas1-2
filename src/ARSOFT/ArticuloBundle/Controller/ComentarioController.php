<?php
namespace ARSOFT\ArticuloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ARSOFT\ArticuloBundle\Entity\Comentario;
use ARSOFT\ArticuloBundle\Form\ComentarioType;


class ComentarioController extends Controller
{
    public function crearComentarioSinTypeAction(Request $request, $articuloId)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('ARSOFTArticuloBundle:Articulo')->find($articuloId);
        
        if (!$articulo) {
            throw $this->createNotFoundException('No se encontró el artículo.');
        }

        $comentario = new Comentario();
        $comentario->setArticulo($articulo);

        $form = $this->createFormBuilder($comentario)
            ->add('autor', 'text')
            ->add('contenido', 'textarea')
            ->add('respuesta', 'integer', array('required' => false))
            ->add('guardar', 'submit', array('label' => 'Publicar Comentario'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comentario);
            $em->flush();

            return $this->redirect($this->generateUrl('comentario_sin_type', array('id' => $articuloId)));
        }

        return $this->render('ARSOFTArticuloBundle:MisVistas:comentario_sin_type.html.twig', array(
            'form' => $form->createView(),
            'articulo' => $articulo
        ));
    }

    public function CrearComentarioConTypeAction(Request $request, $articuloId)
    {
        $comentario = new Comentario();
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comentario);
            $em->flush();

            return $this->redirect($this->generateUrl('comentario_con_type', array('id' => $articuloId)));
        }

        return $this->render('ARSOFTArticuloBundle:Comentario:comentario_con_type.html.twig', [
            'form' => $form->createView(),
            'articuloId' => $articuloId,
        ]);
    }

}
