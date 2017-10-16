<?php

namespace QS\BookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as FT;

class VisitorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', FT\TextType::class, [
                'label' => 'Nom',
            ])
            ->add('firstName', FT\TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('birthDate', FT\BirthdayType::class, [
                'label' => 'Date de naissance',
            ])
            ->add('country', FT\ChoiceType::class , [
                'label' => 'Pays de résidence',
                'choices' => [
                    'France' => 'france',
                    'Autre' => 'other',
                ]
            ])
            ->add('discount', FT\CheckboxType::class, [
                'label' => 'Tarif réduit ?',
                'required' => false
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QS\BookingBundle\Entity\Visitor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'qs_bookingbundle_visitor';
    }


}
