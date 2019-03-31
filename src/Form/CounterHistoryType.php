<?php

namespace App\Form;

use App\Entity\CounterHistory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CounterHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('counter_id')
            ->add('save', SubmitType::class, array(
                'label' => '+',
                'attr' => [
                    'class' => 'btn btn-default',
                ]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CounterHistory::class,
        ]);
    }
}
