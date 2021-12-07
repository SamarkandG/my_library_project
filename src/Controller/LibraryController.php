<?php

namespace App\Controller;

use App\Entity\Books;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    //Ici je récupère grâce à symfony les information que j'ai besoin d'afficher qui se trouvent en base de données
    /**
     * @Route ("/", name="home")
     */
    // Ici je créer une fonction "HOME" pour n'afficher que les 3 premiers livres sur ma page d'accueil
    // Avec symfony quand tu passe le nom d'une classe plus une variable, il instance une classe à ma place

    public function home(BookRepository $bookRepository)
    {
        // j'utilise la méthode findBY de la classe BookRepository, indique je souhaite récupérer avec l'ID les 3 premiers livres dans l'ordre décroissant
        $books = $bookRepository->findBy([],['id'=>'DESC'],3);

        return $this->render("home.html.twig", ['home'=> $books]);

    }

    /**
     * @Route ("/books", name="books")
     */
    public function books(BookRepository $bookRepository)
    {
        // Ici je rme sers de BOOKREPOSITORY pour afficher l'ensemble des livres stockés en base de données
        $books = $bookRepository->findAll();

        return $this->render("books.html.twig",['books'=> $books]);
    }

    // Ici je créer une route pour commencer à créer une interface destinée à la  création
    // D'un formulaire qui me permettras de rajouter des livres à ma BDD

    /**
     * @Route("/book/create", name="book_create")
     */

    // Ici je créer ma nouvele fonction pour créer des nouveaux livres

    public function createBook()
    {
        //créer un livre en BDD
        //Je remplis les même champs ue ceux dans ma BDD
        $book = new Books();
        $book->setTitle("Les Thanatonautes");
        $book->setAuthor("Bernard Werber");
        $book->setnbPages("700");
        $book->setPublishedAt(new \DateTime('1995-12-12'));

        dump($book); die;

    }


    /**
     * @Route ("/book/{id}", name="book")
     */
    //Ici je créer une fonction me permettant d'afficher sur une page uniquement les livres sélectionnés en fonction de leur ID
    public function book($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("book.html.twig",['book'=> $book]);
    }

}