<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Please enter the product name.']),
                ],
            ])
            ->add('description', null, [
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Available' => 'Available',
                    'Rented' => 'Rented',
                    'Under Maintenance' => 'UnderMaintenance',
                ],
                'placeholder' => 'Select status',
                'constraints' => [
                    new NotBlank(['message' => 'Please select a status.']),
                ],
            ])
            ->add('quantite', IntegerType::class, [
                'label' => 'Quantity',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a quantity.']),
                    new Type(['type' => 'integer', 'message' => 'The quantity must be an integer.']),
                    new GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Enter a valid number. The quantity cannot be negative.',
                    ]),
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Product Image',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ]),
                ],
            ]); 
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

