<?php

namespace App\Controller;

//Ici je fais appel à mon entité AUTHOR

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAuthorsController extends AbstractController
{
// Ici je crée une route pour commencer à créer une interface destinée à la création
// D'un formulaire qui me permettras de rajouter des noms d'auteurs


    /**
     * @Route("/admin/author/create", name="admin_author_create")
     */

    //J'utilise et je crée une nouvelle instance de la classe AUTHORS
    // pour pouvoir par la suite utiliser des variables et les remplir
    //Doctrine sert à prendre l'entité et toutes les données, les enregistre et les mets en base de connées

    public function createAuthor(Request $request,EntityManagerInterface $entityManager)
    {
        $author = new Author();
        $authorForm = $this->createForm(AuthorType::class, $author);


        $authorForm->handleRequest($request);



        if ($authorForm->isSubmitted() && $authorForm->isValid()) {



            $entityManager->persist($author);
            $entityManager->flush();
        }
        return $this->render('/Admin/author_create.html.twig', ['authorForm' =>$authorForm->createView()]);
    }






    // Ici je crée une fonction pour me permettre de faire des updates sur les auteurs déjà existants
    //J'utilise et je crée une nouvelle instance de la classe AUTHORS
    // pour pouvoir par la suite utiliser des variables et les remplir
    //Doctrine sert à prendre l'entité et toutes les données, les enregistre et les mets en base de connées


    /**
     * @Route("/admin/author/update/{id}", name="admin_author_update")
     */
    public function authorUpdate($id, AuthorsRepository $authorRepository, EntityManagerInterface $entityManager, Request $request)
    {
        //je récupère donc grace a la méthode find ici l'auteur correspondant a l'id(la wild card) rentré dans lurl
        $authorUpdate = $authorRepository->find($id);

        $authorForm = $this->createForm(AuthorType::class, $authorUpdate);

        $authorForm->handleRequest($request);

        if ($authorForm->isSubmitted() && $authorForm->isValid())
        {

            $entityManager->persist($authorUpdate);
            $entityManager->flush();

        }

        return $this->render('/Admin/author_update.html.twig',[
            'authorForm'=>$authorForm->createView()
        ]);
    }


    // Ici je créer une route "un accès" pour mon URL, pour accéder à la page des auteurs
    /**
     * @Route ("/admin/authors", name="admin_authors")
     */

    // Ici je créer une fonction qui va me permettre d'accéder aux données voulues lorsque j'utiliserais le mot "authors" dans une mage twig
    public function authors(AuthorsRepository $authorsRepository)
    {
        // Ici je me sers de AUTHORREPOSITORY pour afficher l'ensemble des livres stockés en base de données sur ma page HTML
        $authors = $authorsRepository->findAll();

        return $this->render("admin/authors.html.twig",['authors'=> $authors]);
    }

    // Ici je créer une route vers une page qui va me permettre de supprimer un AUTEUR déjà existant dans ma base de données


    /**
     * @Route("/admin/author/delete/{id}", name="admin_author_delete")
     */

    //Ici je crée une instance de mon entité BOOKS qui va me permettre d'utiliser "ENTITY MANGER" et DOCTRINE
    public function authorDelete($id, AuthorsRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        // Doctrine va chercher l'auteur que je souhaite supprimer en BDD grâce à l'ID que je sélectionne
        $author = $authorRepository->find($id);

        // Ici "entity manager" va me permettre d'enlever mon auteur de ma base de donnée avec les fonctions "remove" et "flush"
        $entityManager->remove($author);
        $entityManager->flush();

        return $this->render("author_delete.html.twig");
    }


    /**
     * @Route("/admin/author/{id}", name="admin_author")
     */
    public function author($id, AuthorsRepository $authorRepository)
    {
        $author = $authorRepository->find($id);
        return $this->render('admin/author.html.twig', [
            'author' => $author
        ]);
    }


}