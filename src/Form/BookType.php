<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Books;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


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
            ->add('publishedAt', DateType::class, [
                'widget' => 'single_text'
            ])
            //Pour pouvoir utiliser un menu déroulant pour choisir mon auteur
                // Je crée une class avec ENTITY qui s'appelle "author"
                //Je lie ma class AUTHOR à mon ENTITY AUTHOR
                //J'utilise la variable $author comme référent pour mes choix dans la liste
                // Je retourne sur mon formulaire Le Prénom et le Nom de mon auteur
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => function ($author) {
                    return $author->getFirstName() . ' ' .  $author->getLastName();
                }
            ])
            //Ici j'ai rajouté dans mon formulaire un bouton "valider" pour faire l'action d'envoyer
                // le nouveau livre en base de données
            ->add('submit', SubmitType::class)

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
