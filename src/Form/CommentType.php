<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'required' => true,
                'label' => 'Votre message',
                'constraints' => [
                    new Regex([
                        'pattern' => '/[a-zA-Z]{3,}[a-zA-Z0-9\-]*/',
                        'message' => 'Le message doit contenir au moins 3 lettres.',
                    ]),
                ],
            ])
            //             ->add('createAt', null, [
            //                 'widget' => 'single_text',
            //             ])
            //             ->add('updateAt', null, [
            //                 'widget' => 'single_text',
            //             ])
            //             ->add('trick', EntityType::class, [
            //                 'class' => Trick::class,
            // 'choice_label' => 'id',
            //             ])
            //             ->add('user', EntityType::class, [
            //                 'class' => User::class,
            // 'choice_label' => 'id',
            //             ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer', // Libellé du bouton
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
