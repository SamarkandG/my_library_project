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
// Ici je créer une route pour commencer à créer une interface destinée à la  création
// D'un formulaire qui me permettras de rajouter des nom d'auteurs
    /**
     * @Route("/author/create", name="author_create")
     */

    // Ici je créer ma nouvelle fonction pour créer des nouveaux auteurs

    //J'utilise et je créer une nouvelle instance de la classe AUTHORS
    // pour pouvoir par la suite utiliser des variables et les remplir
    //Doctrine sert à prendre l'entité et toutes les données, les enregistre et les mets en base de connées

    public function createAuthor(EntityManagerInterface $entityManager)
    {
        //créer un auteur en BDD
        // j'instancie la class Author pour en suite integrer des valeurs via les methodes "setter"
        //Je remplis les même champs ue ceux dans ma BDD

        $author = new Author();
        $author->setfirstName("Bernard");
        $author->setlastName("Werber");
        $author->setdeathDate(new \DateTime('1995-12-12'));

        //Je DUMP pour savoir si tout fonctionne et s'affiche correctement
        // Symfony va utiliser ma classe ENTITYMANAGER pour instancier cette classe (autowire)
        //
        $entityManager->persist($author);
        $entityManager->flush();

        return $this->render('book_create.html.twig');
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

}