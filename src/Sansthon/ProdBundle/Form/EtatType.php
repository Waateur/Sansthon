<?php

namespace Sansthon\ProdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EtatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut')
            ->add('fin')
            ->add('stocked')
            ->add('quantite')
            ->add('commentaire')
            ->add('etape')
            ->add('personne')
            ->add('type')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sansthon\ProdBundle\Entity\Etat'
        ));
    }

    public function getName()
    {
        return 'sansthon_prodbundle_etattype';
    }
}
