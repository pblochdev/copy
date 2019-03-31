<?php

namespace App\Form;

use App\Entity\Excercise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ExcerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('repetition', NumberType::class, [
                'attr' => [
                    'type' => 'text',
                    'placeholder' => 'Repetition'
                ]
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => [
                    'type' => 'text',
                    'placeholder' => 'Name'
                ]
            ])
            ->add('weight', NumberType::class, [
                'attr' => [
                    'type' => 'text',
                    'placeholder' => 'Weight'
                ]
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Excercise::class,
            'csrf_protection' => false,
        ]);
    }
}
