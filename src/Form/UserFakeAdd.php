<?php

namespace App\Form;

use App\Entity\UserFake;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserFakeAdd extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, array(
                'row_attr' => array(
                    'class' => 'form-group'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('lastName', TextType::class, array(
                'row_attr' => array(
                    'class' => 'form-group'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserFake::class,
        ]);
    }

}
