<?php

namespace Sukaldaris\InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array('label' => 'Nombre', 'scale'=> 2, 'attr'=>('step' => 0.01, 'min' => 0)))
            ->add('precio','integer', array('label' => 'Precio por unidad', 'attr' => array( 'min' => '0',)))
            ->add('medida','entity', array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Subconcept',
                'property' => 'subconcept',
                'multiple' => false,
                'expanded' => false,
                'label' => 'Medida'
              ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sukaldaris\InfoBundle\Entity\Ingrediente'
        ));
    }
}
