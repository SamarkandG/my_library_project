<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminLibraryController extends AbstractController
{
    //Ici je récupère grâce à symfony les informations que j'ai besoin d'afficher qui se trouvent en base de données
    /**
     * @Route ("/", name="home")
     */
    // Ici je crée une fonction "HOME" pour n'afficher que les 3 premiers livres sur ma page d'accueil
    // Avec symfony quand tu passes le nom d'une classe plus une variable, il instance une classe à ma place

    public function home(BookRepository $bookRepository)
    {
        // j'utilise la méthode findBY de la classe BookRepository, indique je souhaite récupérer avec l'ID les 3 premiers livres dans l'ordre décroissant
        $books = $bookRepository->findBy([],['id'=>'DESC'],3);

        return $this->render("home.html.twig", ['home'=> $books]);

    }

    /**
     * @Route ("admin/books", name="admin_books")
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
     * @Route("admin/book/create", name="admin_book_create")
     */

    // Ici je crée ma nouvelle fonction pour créer des nouveaux livres
    //J'utilise et je crée une nouvelle instance de la classe BOOKS
    // pour pouvoir par la suite utiliser des variables et les remplir
    //Doctrine sert à prendre l'entité et toutes les données, les enregistre et les mets en base de connées

    public function createBook(Request $request, EntityManagerInterface $entityManager)
    {
        $book = new Books();
        $bookForm = $this->createForm(BookType::class, $book);

        //Ici j'utilise ma classe REQUEST pour pouvoir récupérer les informations de mon formulaire (associer mon formulaire à ma classe)

        $bookForm->handleRequest($request);

        // Ici j'utilise la méthode "isSubmitted" de la classe bookForm pour savoir si les données de mon formulaire ont bien été "envoyées"
        //Et la méthode "IsValid" pour vérifier que les données présentent et envoyés sont en accordance avec le type de données que je souhaite récupérer
        //Du style "string" = "string" et non pas "string" = "text" par exemple

        if ($bookForm->isSubmitted() && $bookForm->isValid()) {

            //Une fois que ces 2 conditions mises dans une boucle sont "ok" alors les méthodes d'entityManager : persist et push récupère les données du formulaire et
            //les inscrivent bien en base de données.

            $entityManager->persist($book);
            $entityManager->flush();


            // permet d'enregistré un message qui devra ensuite être affiché dans le twig
            $this->addFlash('success', "Le livre a bien été enregistré !");

            return $this->redirectToRoute('admin_books');
        }
        return $this->render('Admin/book_create.html.twig', ['bookForm' =>$bookForm->createView()]);

    }


    /**
     * @Route("/admin/book/update/{id}", name="admin_book_update")
     */
    public function updateBook($id, Request $request,EntityManagerInterface $entityManager, BookRepository $bookRepository)
    {
        // aller un chercher un livre (doctrine va me donner un objet, une instance de la classe Book)
        $book = $bookRepository->find($id);

        // Ici je peux modifier une valeur grâce aux méthodes de "setters"
        $bookForm = $this->createForm(BookType::class, $book);


        $bookForm->handleRequest($request);

        if ($bookForm->isSubmitted() && $bookForm->isValid()) {


            // Ici la méthode "entity manager" me permet d'enregistrer et pousser en base de donnée mes changements
            $entityManager->persist($book);
            $entityManager->flush();
        }

        return $this->render("admin/book_update.html.twig", [
            'bookForm' => $bookForm->createView()]);
    }


    // Ici je crée une route vers une page qui va me permettre de supprimer un livre déjà existant dans ma base de données


    /**
     * @Route("admin/book/delete/{id}", name="admin_book_delete")
     */

    //Ici je crée une instance de mon entité BOOKS qui va me permettre d'utiliser "ENTITY MANGER" et DOCTRINE
    public function bookDelete($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        // Doctrine va chercher le livre que je souhaite supprimer en BDD grâce à l'ID que je sélectionne
        $book = $bookRepository->find($id);

        // Ici "entity manager" va me permettre d'enlever mon livre de ma base de donnée avec les fonctions "remove" et "flush"
        $entityManager->remove($book);
        $entityManager->flush();

        return$this->redirectToRoute('admin_books');
    }


    /**
     * @Route ("admin/book/{id}", name="admin_book")
     */
    //Ici je créer une fonction me permettant d'afficher sur une page uniquement les livres sélectionnés en fonction de leur ID
    public function book($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("Admin/book.html.twig",['book'=> $book]);
    }



    /**
     * @Route("/admin/search", name="admin_search_books")
     */
    public function searchBooks(BookRepository $bookRepository, Request $request)
    {

        // je récupère ce que tu l'utilisateur a recherché grâce à la classe Request
        $word = $request->query->get('q');

        // je fais ma requête en BDD grâce à la méthode que j'ai créée searchByTitle
        $books = $bookRepository->searchByTitle($word);

        return $this->render('admin/books_search.html.twig', [
            'books' => $books
        ]);
    }

}