<?php

namespace App\Form\Type;

use App\Entity\SettleDebts;
use App\Entity\UserFake;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class settleDebtsAdd extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, array(
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
            ->add('amount', NumberType::class, array(
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
            'data_class' => SettleDebts::class,
        ]);
    }

}
