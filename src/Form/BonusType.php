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
            ->add('bonusPV')
            ->add('bonusAtk')
            ->add('bonusDef')
            ->add('bonusAgi')
            ->add('bonusInt')
            ->add('chapitres', EntityType::class, [
                'class' => Chapitre::class,
                'choice_label' => 'id',
                'multiple' => true,
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
