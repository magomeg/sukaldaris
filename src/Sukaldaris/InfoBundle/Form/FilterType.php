<?php

namespace Sukaldaris\InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('ingrediente', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Ingrediente','property' => 'nombre','label' => 'Ingrediente', 'expanded' => false, 'required'=> false))
             ->add('tecnica', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Tecnica','property' => 'nombre','label' => 'Tecnica', 'expanded' => false, 'required'=> false))
             ->add('categoria', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Categoria','property' => 'nombre','label' => 'Categoria', 'expanded' => false, 'required'=> false))
             ->add('chef', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Chef','property' => 'nombre','label' => 'Chef', 'expanded' => false, 'required'=> false))
        ;
    }
    

}
