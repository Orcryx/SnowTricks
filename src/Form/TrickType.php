<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class TrickType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['required' => true, 'label' => 'Nom du trick', 'constraints' => [
                new Regex([
                    'pattern' => '/[a-zA-z]{3,}[a-zA-Z-0-9\-]*/',
                    // 'message' => 'Le titre doit contenir au moins 3 caratères',
                ]),
            ]])
            ->add('slug', HiddenType::class, [
                'required' => false,
            ])
            ->add('description')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('picture', CollectionType::class, [
                'entry_type' => PictureType::class,
                'entry_options' => ['label' => false], //retirer le label (0,1,etc.)
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('video', CollectionType::class, [
                'entry_type' => VideoType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer', // Libellé du bouton
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
