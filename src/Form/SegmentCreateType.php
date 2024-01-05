<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Domain\Entity\Segment;
use Domain\Entity\Restaurant;

class SegmentCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [])
            ->add('restaurants', EntityType::class, [
                'class' => Restaurant::class,
                'label' => 'Restaurantes',
                'choice_label' => 'name',
                'attr' => ['data-select' => 'true'],
                'multiple' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Crear', 
            ]);
    }
}
