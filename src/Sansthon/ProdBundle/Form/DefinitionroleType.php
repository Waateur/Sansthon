<?php

namespace Sansthon\ProdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DefinitionroleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etape')
            ->add('role')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sansthon\ProdBundle\Entity\Definitionrole'
        ));
    }

    public function getName()
    {
        return 'sansthon_prodbundle_definitionroletype';
    }
}
