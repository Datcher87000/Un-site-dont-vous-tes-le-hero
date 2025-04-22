<?php

namespace App\Form;

use App\Entity\Bonus;
use App\Entity\Chapitre;
use App\Entity\Equipement;
use App\Entity\Histoire;
use App\Entity\Malus;
use App\Entity\Monstre;
use App\Entity\StatHero;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapitreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('numChapitre')
            ->add('histoire', EntityType::class, [
                'class' => Histoire::class,
                'choice_label' => 'titre',
            ])
            ->add('monstres', EntityType::class, [
                'class' => Monstre::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('bonus', EntityType::class, [
                'class' => Bonus::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('malus', EntityType::class, [
                'class' => Malus::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipement::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('choix', CollectionType::class, [
                'entry_type' => ChoixType::class, // Sous-formulaire pour l'entité Choix
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapitre::class,
        ]);
    }
}
