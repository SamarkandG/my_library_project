<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class BookType extends AbstractType
{
    // Ici avec mon "commander" j'ai créé un formulaire avec la commande "make:form"
    //Cette classe est donc apparue pour me permettre de manipuler mon formulaire auto générer par symfony
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        // Ici tous mes champs s'affichent, SYMFONY va chercher tous les champs de ma table "BOOK" et les mettre dans mon formulaire
        $builder
            ->add('title')
            ->add('nbPages')
            ->add('publishedAt')
            //Ici j'ai rajouté dans mon formulaire un bouton "valider" pour faire l'action d'envoyer
                // le nouveau livre en base de données
            ->add('valider', SubmitType::class)

            // ->add('genre')
            //->add('author')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
