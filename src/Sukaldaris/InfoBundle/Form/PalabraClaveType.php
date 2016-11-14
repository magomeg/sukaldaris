<?php

namespace Sukaldaris\InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PalabraClaveType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subscriber = new AddEntityChoiceSubscriber($options['em'], $options['class']);
        $builder->addEventSubscriber($subscriber);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return EntityType::class;
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tag';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sukaldaris\InfoBundle\Entity\PalabraClave'
        ));
    }
}
