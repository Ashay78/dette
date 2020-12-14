<?php

namespace App\Form\Type;

use App\Entity\Debt;
use App\Entity\UserFake;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DebtAdd extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, array(
                'row_attr' => array(
                    'class' => 'form-group'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('userReceives', EntityType::class, array(
                'class' => UserFake::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'ASC');
                },
                'choice_label' => function (UserFake $user) {
                    return $user->getFirstName() . ' ' . $user->getLastName();
                },
                'row_attr' => array(
                    'class' => 'form-group'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'row_attr' => array(
                    'class' => 'form-group'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('isSubscription', CheckboxType::class, array(
                'attr' => array(
                    'class' => 'form-check-input'
                ),
                'label_attr' => array(
                    'class' => 'form-check-label'
                ),
                'label' => 'Abonnement',
                'required' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Debt::class,
        ]);
    }

}
