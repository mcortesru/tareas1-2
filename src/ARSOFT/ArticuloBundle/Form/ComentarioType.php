<?php

namespace ARSOFT\ArticuloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComentarioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('autor')
            ->add('contenido')
            ->add('respuesta')
            ->add('articulo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ARSOFT\ArticuloBundle\Entity\Comentario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'arsoft_articulobundle_comentario';
    }
}
