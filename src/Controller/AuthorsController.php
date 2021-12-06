<?php

namespace App\Controller;

use App\Repository\AuthorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorsController extends AbstractController
{

    /**
     * @Route ("/authors", name="authors")
     */

    public function authors(AuthorsRepository $authorsRepository)
    {
        // Ici je me sers de AUTHORREPOSITORY pour afficher l'ensemble des livres stockés en base de données sur ma page HTML
        $authors = $authorsRepository->findAll();

        return $this->render("authors.html.twig",['authors'=> $authors]);
    }

}