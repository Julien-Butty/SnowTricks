<?php

namespace App\Form;

use App\Entity\TricksForm;
use App\Entity\TrickGroup;
use App\Repository\TrickGroupRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TricksFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('trick_group', EntityType::class, [
                'placeholder' => 'Choisissez un groupe de figure',
                'class' => TrickGroup::class,
                'query_builder' => function (TrickGroupRepository $repo) {
                    return $repo->AlphabeticalOrder();
                }
            ])
            ->add('content', TextareaType::class, [
                'attr' => array('class' => 'justify-content')
            ])
            ->add('images', FileType::class, array('label' => 'images (jpeg)'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => 'App\Entity\Trick',
        ]);
    }
}
