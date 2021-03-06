<?php

namespace Sukaldaris\InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class IngredienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array('label' => 'Nombre', ))
            ->add('precio',IntegerType::class, array('label' => 'Precio por unidad','required' => false, 'attr' => array('step' => 0.01, 'min' => 0)))
            ->add('medida',EntityType::class, array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Subconcept',
                'property' => 'subconcept',
                'multiple' => false,
                'expanded' => false,
                'label' => 'Medida'
              ))
            ->add('temporada', EntityType::class, array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Mes',
                'property' => 'mes',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Temporada'
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
