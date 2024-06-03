<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('locationDate', null, [
                'widget' => 'single_text'
            ])
            ->add('returnDate', null, [
                'widget' => 'single_text'
            ])
            ->add('totalAmount')
            ->add('transportPrice')
            ->add('guardPrice')
            ->add('status',ChoiceType::class,[
                'choices' => [
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                    'Annulé' => 'Annulé'
                ]
            ])
            ->add('address')
            ->add('client', EntityType::class, [
                'class' => Client::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
