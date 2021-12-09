<?php

namespace App\Controller;

use App\Entity\Books;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    //Ici je récupère grâce à symfony les informations que j'ai besoin d'afficher qui se trouvent en base de données
    /**
     * @Route ("Admin/", name="home")
     */
    // Ici je crée une fonction "HOME" pour n'afficher que les 3 premiers livres sur ma page d'accueil
    // Avec symfony quand tu passes le nom d'une classe plus une variable, il instance une classe à ma place

    public function home(BookRepository $bookRepository)
    {
        // j'utilise la méthode findBY de la classe BookRepository, indique je souhaite récupérer avec l'ID les 3 premiers livres dans l'ordre décroissant
        $books = $bookRepository->findBy([],['id'=>'DESC'],3);

        return $this->render("Admin/home.html.twig", ['home'=> $books]);

    }

    /**
     * @Route ("admin/books", name="books")
     */
    public function books(BookRepository $bookRepository)
    {
        // Ici je rme sers de BOOKREPOSITORY pour afficher l'ensemble des livres stockés en base de données
        $books = $bookRepository->findAll();

        return $this->render("Admin/books.html.twig",['books'=> $books]);
    }

    // Ici je crée une route pour commencer à créer une interface destinée à la création
    // D'un formulaire qui me permettras de rajouter des livres à ma BDD

    /**
     * @Route("admin/book/create", name="book_create")
     */

    // Ici je crée ma nouvelle fonction pour créer des nouveaux livres
    //J'utilise et je crée une nouvelle instance de la classe BOOKS
    // pour pouvoir par la suite utiliser des variables et les remplir
    //Doctrine sert à prendre l'entité et toutes les données, les enregistre et les mets en base de connées

    public function createBook(EntityManagerInterface $entityManager)
    {
        //créer un livre en BDD
        // j'instancie la class createBook pour en suite intégrer des valeurs via les méthodes "setter"
        //Je remplis les mêmes champs que ceux dans ma BDD

        $book = new Books();
        $book->setTitle("Les Thanatonautes");
        $book->setAuthor("Bernard Werber");
        $book->setnbPages("700");
        $book->setPublishedAt(new \DateTime('1995-12-12'));

        //Je DUMP pour savoir si tout fonctionne et s'affiche correctement
        // Symfony va utiliser ma classe ENTITYMANAGER pour instancier cette classe (autowire)

        $entityManager->persist($book);
        $entityManager->flush();

        // return pour utiliser cette nouvelle fonction dans ma nouvelle page HTML
        // Idéalement pour l'utiliser dans un formulaire

        return $this->render('Admin/book_create.html.twig');

    }


    /**
     * @Route("admin/book/update/{id}", name="book_update")
     */
    public function updateBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        // aller un chercher un livre (doctrine va me donner un objet, une instance de la classe Book)
        $book = $bookRepository->find($id);

        // Ici je peux modifier une valeur grâce aux méthodes de "setters"
        $book->setTitle('Mad Max reloaded');

        // Ici la méthode "entity manager" me permet d'enregistrer et pousser en base de donnée mes changements
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->render('Admin/book_update.html.twig');
    }


    // Ici je crée une route vers une page qui va me permettre de supprimer un livre déjà existant dans ma base de données


    /**
     * @Route("admin/book/delete/{id}", name="book_delete")
     */

    //Ici je crée une instance de mon entité BOOKS qui va me permettre d'utiliser "ENTITY MANGER" et DOCTRINE
    public function bookDelete($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        // Doctrine va chercher le livre que je souhaite supprimer en BDD grâce à l'ID que je sélectionne
        $book = $bookRepository->find($id);

        // Ici "entity manager" va me permettre d'enlever mon livre de ma base de donnée avec les fonctions "remove" et "flush"
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->render("Admin/books.html.twig");
    }


    /**
     * @Route ("admin/book/{id}", name="book")
     */
    //Ici je créer une fonction me permettant d'afficher sur une page uniquement les livres sélectionnés en fonction de leur ID
    public function book($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("Admin/book.html.twig",['book'=> $book]);
    }

}