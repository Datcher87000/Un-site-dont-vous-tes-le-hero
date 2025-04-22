<?php

namespace App\Form;

use App\Entity\Chapitre;
use App\Entity\Malus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MalusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('malusPv')
            ->add('malusAtk')
            ->add('malusDef')
            ->add('malusAgi')
            ->add('malusInt')
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
            'data_class' => Malus::class,
        ]);
    }
}
