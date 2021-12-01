<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Books extends AbstractController
{

    /**
     * @Route("/book/{id}", name="book");
     */
    public function BookShow($id)
    {

        //Juste en dessous j'ai mon tableau qui contient chacun de mes livres et leur caractéristiques et leur $id pour les identifier

        $books = [
            1 => [
                "title" => "Dune",
                "author" => "Franck Herbert",
                "image" => "https://www.indiependent.co.uk/wp-content/uploads/2020/06/A1u2fY5yTL-scaled.jpg",
                "synopsis" => "Paul Atreides, a brilliant and gifted young man born into a great destiny beyond his understanding, 
                                must travel to the most dangerous planet in the universe to ensure the future of his family and his people. 
                                As malevolent forces explode into conflict over the planet's exclusive supply of the most precious resource in 
                                existence-a commodity capable of unlocking humanity's greatest potential-only those who can conquer their fear will survive.",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 1
            ],
            2 => [
                "title" => "I am Pilgrim",
                "author" => "Tery Hayes",
                "image" => "https://i.pinimg.com/originals/48/cb/ee/48cbeea0ea2c6267bd65e2b7948132df.jpg",
                "synopsis" => "'Pilgrim' is an American former intelligence agent known as the 'Rider of the Blue' who later writes a book 
                                on forensic pathology. Pilgrim becomes involved in a case in New York City where a mysterious woman uses his 
                                book to commit untraceable murders in the aftermath of 9/11. The 'Saracen' is a Saudi who becomes radicalised 
                                by watching his father's beheading. He later trains as a doctor and fights in the Soviet–Afghan War. Pilgrim is 
                                recalled to the intelligence community who have detected a threat involving the Saracen, who has created a vaccine-resistant 
                                strain of the variola major virus.",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "author" => "Harlan Coben",
                "image" => "https://www.grandcentralpublishing.com/wp-content/uploads/2020/07/9781538748213-1.jpg?fit=497%2C750",
                "synopsis" => "Over twenty years ago, the heiress Patricia Lockwood was abducted during a robbery of her family's estate, 
                               then locked inside an isolated cabin for months. Patricia escaped, but so did her captors — and the items stolen from her 
                               family were never recovered. Until now. On the Upper West Side, a recluse is found murdered in his penthouse apartment, 
                               alongside two objects of note: a stolen Vermeer painting and a leather suitcase bearing the initials WHL3. For the first
                               time in years, the authorities have a lead — not only on Patricia's kidnapping, but also on another FBI cold case — with
                               the suitcase and painting both pointing them toward one man. Windsor Horne Lockwood III — or Win, as his few friends call
                               him — doesn't know how his suitcase and his family's stolen painting ended up with a dead man. But his interest is piqued, 
                               especially when the FBI tells him that the man who kidnapped his cousin was also behind an act of domestic terrorism — and
                               that the conspirators may still be at large. The two cases have baffled the FBI for decades, but Win has three things the
                                FBI doesn't: a personal connection to the case; an ungodly fortune; and his own unique brand of justice.",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "author" => "Éric-Emmanuel Schmitt",
                "image" => "https://dynamic.indigoimages.ca/books/2253155373.jpg?scaleup=true&width=614&maxheight=614&quality=85&lang=en",
                "synopsis" =>"8 octobre 1908 : Adolf Hitler recalé. Que se serait-il passé si l'École des beaux-arts de Vienne en avait décidé
                              autrement ? Que serait-il arrivé si, cette minute là, le jury avait accepté et non refusé Adolf Hitler, flatté puis épanoui ses
                              ambitions d'artiste ? Cette minute-là aurait changé le cours d'une vie, celle du jeune, timide et passionné Adolf Hitler, 
                              mais elle aurait aussi changé le cours du monde...",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "author" => "Jo Nesbo",
                "image" => "http://www.deadgoodbooks.co.uk/wp-content/uploads/2017/07/9781784700928.jpg",
                "synopsis" =>"SOON THE FIRST SNOW WILL COME.
                              A young boy wakes to find his mother missing. Their house is empty but outside in the garden he sees his mother’s
                              favourite scarf – wrapped around the neck of a snowman.
                              AND THEN HE WILL APPEAR AGAIN.
                              As Harry Hole and his team begin their investigation they discover that an alarming number of wives and mothers have
                              gone missing over the years.
                              AND WHEN THE SNOW IS GONE…
                              When a second woman disappears it seems that Harry’s worst suspicions are confirmed: for the first time in his career
                              Harry finds himself confronted with a serial killer operating on his home turf.
                              …HE WILL HAVE TAKEN SOMEONE ELSE.",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 5
            ]
        ];

        //Ici on créer une fonction pour nous aider à voir si un livre existe dans notre tableau ou pas en cherchant les $id
        //Si un livre n'existe pas (aucune $id correspondante trouvée) alors on affiche le message "Sorry, we can't find your book :("

        if (!array_key_exists($id, $books)){
            throw $this->createNotFoundException("Sorry, we can't find your book :(");
        }

        //Cette fonction nous permet d'utiliser le mot "book" dans notre HTML.TWIG pour parler de notre variable "$books" avec une distinction des "[$id]"

        return $this->render("book.html.twig", ['book' => $books[$id]]);
    }


    /**
     * @Route("/books", name="books");
     */
    public function BooksList()
    {
        $books = [

            1 => [
                "title" => "Dune",
                "author" => "Franck Herbert",
                "image" => "https://www.indiependent.co.uk/wp-content/uploads/2020/06/A1u2fY5yTL-scaled.jpg",
                "synopsis" => "Paul Atreides, a brilliant and gifted young man born into a great destiny beyond his understanding, 
                                must travel to the most dangerous planet in the universe to ensure the future of his family and his people. 
                                As malevolent forces explode into conflict over the planet's exclusive supply of the most precious resource in 
                                existence-a commodity capable of unlocking humanity's greatest potential-only those who can conquer their fear will survive.",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 1
            ],
            2 => [
                "title" => "I am Pilgrim",
                "author" => "Tery Hayes",
                "image" => "https://i.pinimg.com/originals/48/cb/ee/48cbeea0ea2c6267bd65e2b7948132df.jpg",
                "synopsis" => "'Pilgrim' is an American former intelligence agent known as the 'Rider of the Blue' who later writes a book 
                                on forensic pathology. Pilgrim becomes involved in a case in New York City where a mysterious woman uses his 
                                book to commit untraceable murders in the aftermath of 9/11. The 'Saracen' is a Saudi who becomes radicalised 
                                by watching his father's beheading. He later trains as a doctor and fights in the Soviet–Afghan War. Pilgrim is 
                                recalled to the intelligence community who have detected a threat involving the Saracen, who has created a vaccine-resistant 
                                strain of the variola major virus.",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "author" => "Harlan Coben",
                "image" => "https://www.grandcentralpublishing.com/wp-content/uploads/2020/07/9781538748213-1.jpg?fit=497%2C750",
                "synopsis" => "Over twenty years ago, the heiress Patricia Lockwood was abducted during a robbery of her family's estate, 
                               then locked inside an isolated cabin for months. Patricia escaped, but so did her captors — and the items stolen from her 
                               family were never recovered. Until now. On the Upper West Side, a recluse is found murdered in his penthouse apartment, 
                               alongside two objects of note: a stolen Vermeer painting and a leather suitcase bearing the initials WHL3. For the first
                               time in years, the authorities have a lead — not only on Patricia's kidnapping, but also on another FBI cold case — with
                               the suitcase and painting both pointing them toward one man. Windsor Horne Lockwood III — or Win, as his few friends call
                               him — doesn't know how his suitcase and his family's stolen painting ended up with a dead man. But his interest is piqued, 
                               especially when the FBI tells him that the man who kidnapped his cousin was also behind an act of domestic terrorism — and
                               that the conspirators may still be at large. The two cases have baffled the FBI for decades, but Win has three things the
                                FBI doesn't: a personal connection to the case; an ungodly fortune; and his own unique brand of justice.",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "author" => "Éric-Emmanuel Schmitt",
                "image" => "https://dynamic.indigoimages.ca/books/2253155373.jpg?scaleup=true&width=614&maxheight=614&quality=85&lang=en",
                "synopsis" =>"8 octobre 1908 : Adolf Hitler recalé. Que se serait-il passé si l'École des beaux-arts de Vienne en avait décidé
                              autrement ? Que serait-il arrivé si, cette minute là, le jury avait accepté et non refusé Adolf Hitler, flatté puis épanoui ses
                              ambitions d'artiste ? Cette minute-là aurait changé le cours d'une vie, celle du jeune, timide et passionné Adolf Hitler, 
                              mais elle aurait aussi changé le cours du monde...",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "author" => "Jo Nesbo",
                "image" => "http://www.deadgoodbooks.co.uk/wp-content/uploads/2017/07/9781784700928.jpg",
                "synopsis" =>"SOON THE FIRST SNOW WILL COME.
                              A young boy wakes to find his mother missing. Their house is empty but outside in the garden he sees his mother’s
                              favourite scarf – wrapped around the neck of a snowman.
                              AND THEN HE WILL APPEAR AGAIN.
                              As Harry Hole and his team begin their investigation they discover that an alarming number of wives and mothers have
                              gone missing over the years.
                              AND WHEN THE SNOW IS GONE…
                              When a second woman disappears it seems that Harry’s worst suspicions are confirmed: for the first time in his career
                              Harry finds himself confronted with a serial killer operating on his home turf.
                              …HE WILL HAVE TAKEN SOMEONE ELSE.",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 5
            ],
        ];

        return $this->render("books.html.twig", ['books' => $books]);

    }


}