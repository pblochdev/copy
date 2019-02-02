<?php

namespace App\Form;

use App\Entity\Counter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CounterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Counter name'
                ]
            ])
            ->add('start_counter', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Counter'
                ]
            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Add Note',
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Counter::class,
        ]);
    }
}
