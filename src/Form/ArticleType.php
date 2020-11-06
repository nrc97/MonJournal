<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Auteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'titre',
                TextType::class,
                [
                    'label' => 'Titre : '
                ]
            )
            ->add(
                'intro',
                TextareaType::class,
                [
                    'label' => 'Introduction : ',
                    'attr' => [
                        'cols' => '50',
                        'rows' => '5'
                    ]
                ]
            )
            ->add(
                'texte',
                TextareaType::class,
                [
                    'label' => 'Texte : ',
                    'attr' => [
                        'cols' => '50',
                        'rows' => '12'
                    ]
                ]
            )
            ->add(
                'datePublication',
                DateTimeType::class,
                [
                    'label' => 'Date de publication: '
                ]
            )
            ->add(
                'auteur',
                EntityType::class,
                [
                    'label' => 'Auteur: ',
                    'class' => Auteur::class,
                    //'choice_label' => 'identifiant'
                    'choice_label' => function($auteur) {
                        return $auteur->getPrenom() . ' ' . $auteur->getNom();
                    }
                ]
            )
            ->add(
                'submit',
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
            'data_class' => Article::class,
        ]);
    }
}
