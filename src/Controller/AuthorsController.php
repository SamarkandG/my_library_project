<?php

namespace App\Controller;

//Ici je fais appel à mon entité AUTHOR

use App\Entity\Author;
use App\Repository\AuthorsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorsController extends AbstractController
{
// Ici je crée une route pour commencer à créer une interface destinée à la création
// D'un formulaire qui me permettras de rajouter des noms d'auteurs
    /**
     * @Route("/author/create", name="author_create")
     */

    //J'utilise et je crée une nouvelle instance de la classe AUTHORS
    // pour pouvoir par la suite utiliser des variables et les remplir
    //Doctrine sert à prendre l'entité et toutes les données, les enregistre et les mets en base de connées

    public function createAuthor(EntityManagerInterface $entityManager)
    {

        //créer un livre en BDD
        // j'instancie la class createBook pour en suite intégrer des valeurs via les méthodes "setter"
        //Je remplis les mêmes champs que ceux dans ma BDD

        $author = new Author();
        $author->setfirstName("Bernard");
        $author->setlastName("Werber");
        $author->setdeathDate(new \DateTime('1995-12-12'));

        //Je DUMP pour savoir si tout fonctionne et s'affiche correctement
        // Symfony va utiliser ma classe ENTITYMANAGER pour instancier cette classe (autowire)

        $entityManager->persist($author);
        $entityManager->flush();

            // return pour utiliser cette nouvelle fonction dans ma nouvelle page HTML
        // Idéalement pour l'utiliser dans un formulaire
        return $this->render('author_create.html.twig');
    }





// Ici je créer une route "un accès" pour mon URL, pour accéder à la page des auteurs
    /**
     * @Route ("/authors", name="authors")
     */

    // Ici je créer une fonction qui va me permettre d'accéder aux données voulues lorsque j'utiliserais le mot "authors" dans une mage twig
    public function authors(AuthorsRepository $authorsRepository)
    {
        // Ici je me sers de AUTHORREPOSITORY pour afficher l'ensemble des livres stockés en base de données sur ma page HTML
        $authors = $authorsRepository->findAll();

        return $this->render("authors.html.twig",['authors'=> $authors]);
    }

    // Ici je crée une fonction pour me permettre de faire des updates sur les auteurs déjà existants
    //J'utilise et je crée une nouvelle instance de la classe AUTHORS
    // pour pouvoir par la suite utiliser des variables et les remplir
    //Doctrine sert à prendre l'entité et toutes les données, les enregistre et les mets en base de connées


    /**
     * @Route("/author/update/{id}", name="author_update")
     */
    public function updateAuthor($id, AuthorsRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        //Ici la doctrine par en base de donnée pour trouver le livre que je souhaite modifier grâce à l'ID
        $author = $authorRepository->find($id);

        // Ici je peux modifier une valeur grâce aux méthodes de "setters"
        $author->setTitle('Mad Max reloaded');

        // Ici la méthode "entity manager" me permet d'enregistrer et pousser en base de donnée mes changements
        $entityManager->persist($author);
        $entityManager->flush();

        return $this->render('author_update.html.twig');
    }

}