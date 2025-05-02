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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapitreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class, [
                'label' => 'Titre du Chapitre',

            ])
            ->add('description', null, [
                'label' => 'Description du Chapitre',

            ])
            ->add('numChapitre', IntegerType::class, [
                'label' => 'Numéro du Chapitre',

            ])

            ->add('monstres', EntityType::class, [
                'class' => Monstre::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false, // Désactive le required

            ])
            ->add('bonus', EntityType::class, [
                'class' => Bonus::class,
                'choice_label' => 'id',
                'multiple' => true,
                'required' => false, // Désactive le required

            ])
            ->add('malus', EntityType::class, [
                'class' => Malus::class,
                'choice_label' => 'id',
                'multiple' => true,
                'required' => false, // Désactive le required

            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipement::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false, // Désactive le required

            ])
            ->add('choix', CollectionType::class, [
                'entry_type' => ChoixType::class, // Sous-formulaire pour l'entité Choix
                'allow_add' => true, // Permet l'ajout dynamique
                'allow_delete' => true, // Permet la suppression dynamique
                'by_reference' => false, // Nécessaire pour les collections
                'prototype' => true, // Génère un prototype pour les nouveaux éléments
                'prototype_name' => '__name__', // Définit le placeholder pour l'index
                'required' => false, // Désactive le required
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapitre::class,
            'csrf_protection' => true, // Active la protection CSRF

        ]);
    }
}
