<?php

namespace Sukaldaris\InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', 'text', array('label' => 'Título'))
            ->add('fecha_publicacion', 'date', array('label' => 'Fecha publicación'))
            ->add('dificultad', 'integer', array('label' => 'Dificultad'))
            ->add('tiempo_cocinado', 'integer', array('label' => 'Dificultad'))
            ->add('tiempo_preparacion', 'integer', array('label' => 'Dificultad'))
            ->add('personas', 'integer', array('label' => 'Dificultad'))
            ->add('id_chef')
            ->add('palabras')
            ->add('tecnicas')
            ->add('utensilios')
    
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sukaldaris\InfoBundle\Entity\Receta'
        ));
    }
}
