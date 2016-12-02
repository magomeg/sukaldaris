<?php
namespace Sukaldaris\InfoBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class IngredienteAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper ->add('nombre', TextType::class, array('label' => 'Nombre', ))
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

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('nombre');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('nombre');
    }
}
?>