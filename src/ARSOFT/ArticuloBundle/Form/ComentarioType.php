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
        ->add('autor', 'text')
        ->add('contenido', 'textarea')
        ->add('respuesta', 'integer', array('required' => false));

        if (!isset($options['articulo']) || $options['articulo'] === null) {
            $builder->add('articulo', 'entity', array(
                'class' => 'ARSOFTArticuloBundle:Articulo',
                'property' => 'titulo',  // Esto crea un desplegable con los títulos de los artículos
            ));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ARSOFT\ArticuloBundle\Entity\Comentario',
            'articulo' => null
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
