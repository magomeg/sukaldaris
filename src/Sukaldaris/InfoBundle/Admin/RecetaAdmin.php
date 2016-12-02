<?php
namespace Sukaldaris\InfoBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Sukaldaris\InfoBundle\Form\CategoriaType;
use Sukaldaris\InfoBundle\Form\IngredienteRecetaType;
use Sukaldaris\InfoBundle\Form\IngredienteType;
use Sukaldaris\InfoBundle\Form\PalabraClaveType;
use Sukaldaris\InfoBundle\Form\PasoType;
use Sukaldaris\InfoBundle\Form\TecnicaType;
use Sukaldaris\InfoBundle\Form\UtensilioType;


class RecetaAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper ->add('titulo', TextType::class, array('label' => 'Título de la receta'))

            ->add('dificultad', 'integer', array('label' => 'Nivel dificultad', 'required' => false, 'attr' => array( 'min' => '1', 'max' => '5',)) )
            ->add('tiempo_preparacion', IntegerType::class, array('label' => 'Tiempo de preparación', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('tiempo_cocinado', IntegerType::class, array('label' => 'Tiempo de cocinado', 'required' => false, 'attr' => array( 'min' => '0',)))
            
            ->add('personas', IntegerType::class, array('label' => 'Personas', 'required' => false, 'attr' => array( 'min' => '0',)))
            ->add('id_chef', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Chef','choice_label' => 'nombre','label' => 'Chef', 'expanded' => false, 'required'=> false))
            ->add('id_categoria', EntityType::class, array('class' => 'Sukaldaris\InfoBundle\Entity\Categoria','choice_label' => 'categoria','label' => 'Categoria', 'expanded' => false))
            ->add('palabras', CollectionType::class, array(
                'entry_type' => PalabraClaveType::class,
                'allow_add' => true,
                'label' => 'Palabras Clave',
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false
              ))
           ->add('tecnicas', CollectionType::class, array(
                'entry_type' => TecnicaType::class,
                'allow_add' => true,
                'label' => 'Técnicas',
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false
              ))
            ->add('utensilios', CollectionType::class, array(
                'entry_type' => UtensilioType::class,
                'allow_add' => true,
                'label' => 'Utensilios',
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false
              ))
            ->add('pasos', CollectionType::class, array(
                'entry_type' => PasoType::class,
                'allow_add' => true,
                'label' => 'Pasos',
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false
              ))
            
            ->add('path', FileType::class, array('label' => 'Foto','data_class' => null, 'required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('titulo');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('titulo');
    }
}
?>