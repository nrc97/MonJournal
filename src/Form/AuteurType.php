<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'identifiant',
                TextType::class,
                [
                    'label' => 'Identifiant : '
                ]
            )
            ->add('nom',
                TextType::class,
                [
                    'label' => 'Nom: '
                ]
            )
            ->add('prenom',
                TextType::class,
                [
                    'label' => 'Prénom: '
                ]
            )
            ->add('motdepasse',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe ne correspondent pas',
                    'required' => true,
                    'first_options' => ['label' => 'Mot de passe : '],
                    'second_options' => ['label' => 'Confirmez le mot de passe : '],
                    'label' => 'Mot de passe: '
                ]
            )
            ->add('submit',
                SubmitType::class,
                [
                    'label' => 'Enregistrer'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
