<?php

namespace Sukaldaris\InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;


class RecetaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class, array('label' => 'Título de la receta'))
            ->add('dificultad', 'integer', array('label' => 'Nivel dificultad', 'required' => false, 'attr' => array( 'min' => '1', 'max' => '5',)) )
            ->add('tiempo_preparacion', IntegerType::class, array('label' => 'Tiempo de preparación', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('tiempo_cocinado', IntegerType::class, array('label' => 'Tiempo de cocinado', 'required' => false, 'attr' => array( 'min' => '0',)))
            
            ->add('personas', IntegerType::class, array('label' => 'Personas', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('id_chef', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Chef','property' => 'nombre','label' => 'Chef', 'expanded' => false, 'required'=> false))
            ->add('id_categoria', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Categoria','property' => 'categoria','label' => 'Categoria', 'expanded' => false))
            ->add('palabras', Select2EntityType::class, [
            'multiple' => true,
            'remote_route' => 'sukaldaris_select_palabras',
            'class' => 'Sukaldaris\InfoBundle\Entity\PalbraClave',
            'primary_key' => 'id',
            'text_property' => 'palabra',
            'page_limit' => 10,
            'allow_clear' => true,
            
            'language' => 'es',
            'placeholder' => 'Select a country',
        ])
            ->add('tecnicas', EntityType::class, array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Tecnica',
                'property' => 'nombre',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Técnicas',
                'required'=> false
              ))
            ->add('utensilios', EntityType::class, array(
                'class' => 'Sukaldaris\InfoBundle\Entity\Utensilio',
                'property' => 'nombre',
                'multiple' => true,
                'expanded' => false,
                'required'=> false
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
