<?php

namespace App\Form;

use App\Entity\Chapitre;
use App\Entity\Malus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MalusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du Malus',
            ])
            ->add('malusPv', IntegerType::class, [
                'label' => 'Malus PV',
                'attr' => ['min' => 0, 'step' => 5],
            ])
            ->add('malusAtk', IntegerType::class, [
                'label' => 'Malus Attaque',
                'attr' => ['min' => 0],
            ])
            ->add('malusDef', IntegerType::class, [
                'label' => 'Malus Défense',
                'attr' => ['min' => 0],
            ])
            ->add('malusAgi', IntegerType::class, [
                'label' => 'Malus Agilité',
                'attr' => ['min' => 0],
            ])
            ->add('malusInt', IntegerType::class, [
                'label' => 'Malus Intelligence',
                'attr' => ['min' => 0],
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
