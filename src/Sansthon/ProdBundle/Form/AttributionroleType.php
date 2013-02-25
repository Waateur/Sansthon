<?php

namespace Sansthon\ProdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttributionroleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('personne')
            ->add('role')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sansthon\ProdBundle\Entity\Attributionrole'
        ));
    }

    public function getName()
    {
        return 'sansthon_prodbundle_attributionroletype';
    }
}
