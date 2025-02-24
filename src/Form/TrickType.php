<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom du trick',
            ])
            ->add('image')
            ->add('slug', HiddenType::class, [
                'required' => false,
                'mapped' => false, // Désactiver le mapping si le slug est généré automatiquement
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du trick',
                'required' => true,
                'attr' => ['rows' => 5],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'placeholder' => 'Sélectionnez une catégorie',
            ])
            ->add('picture', CollectionType::class, [
                'entry_type' => PictureType::class, // Type du formulaire enfant
                'allow_add' => true, // Permet d'ajouter dynamiquement des images
                'allow_delete' => true, // Permet la suppression
                'by_reference' => false, // Important pour les relations OneToMany
                'prototype' => true, // Permet d'ajouter avec JavaScript
                'attr' => ['class' => 'picture-collection'],
            ])
            ->add('video', CollectionType::class, [
                'entry_type' => VideoType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'attr' => ['class' => 'video-collection'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer le trick',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
