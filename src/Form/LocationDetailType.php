<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\LocationDetail;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('product', EntityType::class, [
            'class' => Product::class,
            'choice_label' => 'name',
            'label' => 'Product',
            'required' => true,
        ])
        ->add('quantity', IntegerType::class, [
            'label' => 'Quantity to reduce',
            'required' => true,
            'attr' => ['min' => 1],
        ])

    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LocationDetail::class,
        ]);
    }
}
