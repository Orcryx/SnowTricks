<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom de la vidéo',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom de la video est obligatoire.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]{3,}[a-zA-Z0-9\- ]*$/',
                        'message' => 'Le nom doit contenir au moins 3 lettres et peut inclure des chiffres et des tirets.',
                    ]),
                ],
            ])
            ->add('src', UrlType::class, [
                'label' => 'URL de la vidéo',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'L’URL de la vidéo est obligatoire.',
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
            'data_class' => Video::class,
        ]);
    }
}
