<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\TricksForm;
use App\Entity\TrickGroup;
use App\Entity\Video;
use App\Repository\TrickGroupRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Hillrange\CKEditor\Form\CKEditorType;

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
            ->add('content', CKEditorType::class, [
                'attr' => array('class' => 'justify-content')
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true
            ])->add('videos', CollectionType::class, [
                'entry_type' => VideoType::class,
                'allow_add' => true
            ]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Trick::class
        ]);
    }
}
