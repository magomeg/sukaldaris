<?php

namespace Sukaldaris\InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
            ->add('tiempo_preparacion', 'integer', array('label' => 'Tiempo de preparación', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('tiempo_cocinado', 'integer', array('label' => 'Tiempo de cocinado', 'required' => false, 'attr' => array( 'min' => '0',)))
            
            ->add('personas', 'integer', array('label' => 'Personas', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('id_chef', 'entity', array('class' => 'Sukaldaris\InfoBundle\Entity\Chef','property' => 'nombre','label' => 'Chef', 'expanded' => false))
            ->add('id_categoria', 'entity', array('class' => 'Sukaldaris\InfoBundle\Entity\Categoria','property' => 'categoria','label' => 'Categoria', 'expanded' => false))
            ->add('palabras', 'genemu_jqueryselect2_entity', array( 'class' => 'Sukaldaris\InfoBundle\Entity\PalabraClave', 'property' => 'palabra' ))
            ->add('tecnicas', 'entity', array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Tecnica',
                'property' => 'nombre',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Técnicas'
              ))
            ->add('utensilios', 'entity', array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Utensilio',
                'property' => 'nombre',
                'multiple' => true,
                'expanded' => false
              ))
            ->add('path', FileType::class, array('label' => 'Foto','data_class' => null, 'required' => false))
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
