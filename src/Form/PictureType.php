<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom de l’image',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom de l’image est obligatoire.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]{3,}[a-zA-Z0-9\- ]*$/',
                        'message' => 'Le nom doit contenir au moins 3 lettres et peut inclure des chiffres et des tirets.',
                    ]),
                ],
            ])
            ->add('src', UrlType::class, [
                'label' => 'URL de l’image',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'L’URL de l’image est obligatoire.',
                    ]),
                    new Url([
                        'message' => 'Veuillez entrer une URL valide.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
