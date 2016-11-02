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
            ->add('titulo', 'text', array('label' => 'Título de la receta'))
            ->add('dificultad', 'integer', array('label' => 'Nivel dificultad', 'required' => false) )
            ->add('tiempo_cocinado', 'integer', array('label' => 'Tiempo de cocinado', 'required' => false))
            ->add('tiempo_preparacion', 'integer', array('label' => 'Tiempo de preparación', 'required' => false))
            ->add('personas', 'integer', array('label' => 'Personas', 'required' => false))
            ->add('id_chef', null, array('label' => 'Chef', 'expanded' => "true"))
            ->add('id_categoria', null, array('label' => 'Categoria', 'expanded' => "true"))
            ->add('palabras')
            ->add('tecnicas')
            ->add('utensilios')
        ;
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
