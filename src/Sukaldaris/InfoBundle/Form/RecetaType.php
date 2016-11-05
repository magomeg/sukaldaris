<?php

namespace Sukaldaris\InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
            ->add('dificultad', 'integer', array('label' => 'Nivel dificultad', 'required' => false, 'attr' => array( 'min' => '1', 'max' => '5',)) )
            ->add('tiempo_cocinado', 'integer', array('label' => 'Tiempo de cocinado', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('tiempo_preparacion', 'integer', array('label' => 'Tiempo de preparación', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('personas', 'integer', array('label' => 'Personas', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('id_chef', null, array('label' => 'Chef', 'expanded' => "true"))
            ->add('id_categoria', null, array('label' => 'Categoria', 'expanded' => "true"))
            ->add('palabras', CollectionType::class, array(
            'entry_type' => PalabraClaveType::class ))
            ->add('tecnicas', 'entity', array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Tecnica',
                'property' => 'nombre',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Técnicas'
              ))
            ->add('utensilios', 'entity', array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Utensilio',
                'property' => 'nombre',
                'multiple' => true,
                'expanded' => true
              ))
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
