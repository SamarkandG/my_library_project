<?php

namespace App\Controller;

//Ici je fais appel à mon entité AUTHOR

use App\Entity\Author;
use App\Repository\AuthorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorsController extends AbstractController
{
// Ici je créer une route pour commencer à créer une interface destinée à la  création
// D'un formulaire qui me permettras de rajouter des nom d'auteurs
    /**
     * @Route("/author/create", name="author_create")
     */

    // Ici je créer ma nouvele fonction pour créer des nouveaux auteurs

    public function createAuthor()
    {
        //créer un auteur en BDD
        //Je remplis les même champs ue ceux dans ma BDD

        $author = new Author();
        $author->setfirstName("Bernard");
        $author->setlastName("Werber");
        $author->setdeathDate(new \DateTime('1995-12-12'));

        //Je DUMP pour savoir si tout fonctionne et s'affiche correctement

        dump($author); die;

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