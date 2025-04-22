<?php

namespace App\Form;

use App\Entity\Chapitre;
use App\Entity\Emplacement;
use App\Entity\Enchantement;
use App\Entity\Equipement;
use App\Entity\StatHero;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('emplacement', EntityType::class, [
                'class' => Emplacement::class,
                'choice_label' => 'name',
            ])
            ->add('enchantements', EntityType::class, [
                'class' => Enchantement::class,
                'choice_label' => 'name',
                'multiple' => true])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
