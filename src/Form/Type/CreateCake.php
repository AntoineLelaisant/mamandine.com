<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Cake;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\GreaterThan;
use App\Validator\Contstraints\ChocolateCake;

class CreateCake extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Cake name'
                ],
                'constraints' => [
                    new NotBlank(),
                    new ChocolateCake(),
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Enter your description'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 100]),
                ],
            ])
            ->add('price', TextType::class, [
                'attr' => [
                    'placeholder' => '32.00'
                ],
                'constraints' => [
                    new NotBlank(),
                    new GreaterThan(0),
                ],
            ])
            ->add('image', TextType::class, [
                'attr' => [
                    'placeholder' => 'https://your.image.uri/someid'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Url(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Cake::class,
            ])
        ;
    }
}
