<?php

namespace App\Form;

use App\Entity\Hero;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('pv', IntegerType::class, [
                'attr' => ['min' => 10, 'step' => 5],
            ])
            ->add('atk', IntegerType::class, [
                'attr' => ['min' => 1],
            ])
            ->add('def', IntegerType::class, [
                'attr' => ['min' => 1],
            ])
            ->add('agi', IntegerType::class, [
                'attr' => ['min' => 1],
            ])
            ->add('intel', IntegerType::class, [
                'attr' => ['min' => 1],
            ]);
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $hero = $event->getData();

            if (!$hero->validateStats()) {
                $form->addError(new FormError('Vous devez répartir exactement 20 points.'));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hero::class,
        ]);
    }
}
