<?php

namespace App\Form;

use App\Entity\Bonus;
use App\Entity\Chapitre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BonusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du Bonus',
            ])
            ->add('bonusPV', null, [
                'label' => 'Bonus PV',
                'attr' => ['min' => 0, 'step' => 5],
            ])
            ->add('bonusAtk', null, [
                    'label' => 'Bonus Attaque',
                    'attr' => ['min' => 0],
                ])
            ->add('bonusDef', null, [
                'label' => 'Bonus Défense',
                'attr' => ['min' => 0],
            ])
            ->add('bonusAgi', null, [
                'label' => 'Bonus Agilité',
                'attr' => ['min' => 0],
            ])
            ->add('bonusInt', null, [
                'label' => 'Bonus Intelligence',
                'attr' => ['min' => 0],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bonus::class,
        ]);
    }
}
