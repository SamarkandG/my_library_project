<?php

namespace App\Controller;

use App\Repository\AuthorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorsController extends AbstractController
{
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