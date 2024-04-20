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
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comentario);
            $em->flush();

            return $this->redirect($this->generateUrl('mostrar_articulo', array('id' => $articuloId)));
        }

        return $this->render('ARSOFTArticuloBundle:MisVistas:comentario_sin_type.html.twig', [
            'form' => $form->createView(),
            'articuloId' => $articuloId,
        ]);
    }

    public function CrearComentarioConTypeAction(Request $request, $articuloId)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('ARSOFTArticuloBundle:Articulo')->find($articuloId);

        if (!$articulo) {
            throw $this->createNotFoundException('El artículo no fue encontrado.');
        }

        $comentario = new Comentario();
        $comentario->setArticulo($articulo);

        $form = $this->createForm(new ComentarioType(), $comentario, [
            'articulo' => $articulo
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comentario);
            $em->flush();

            return $this->redirect($this->generateUrl('mostrar_articulo', ['id' => $articuloId]));
        }

        return $this->render('ARSOFTArticuloBundle:MisVistas:comentario_con_type.html.twig', [
            'form' => $form->createView(),
            'articuloId' => $articuloId,
        ]);

    }

}
