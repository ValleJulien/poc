<?php

namespace AdminBundle\DataFixtures;

use AdminBundle\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Biblys\Isbn\Isbn as Isbn;

class BookFixtures extends Fixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $authors = [
            "Jean Anouilh",
            "Guillaume Musso",
            "Franz-Olivier Giesbert"
        ];

        $books = [
            "L'Insoutenable Légèreté de l'être",
            "J'irai cracher sur vos tombes",
            "Voyage au bout de la nuit",
            "L'Écume des jours",
            "Les Misérables",
            "Le livre Test",
            "Le numéro 23",
        ];

        // create 10 books!
        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book->setId($i);
            $randomAuthor = array_rand($authors);
            $book->setAuthor($authors[$randomAuthor]);
            $randomTitle = array_rand($books);
            $book->setTitle($books[$randomTitle]);
            $timestamp = mt_rand(1, time());
            $book->setPublishedAt(date("Y-m-d", $timestamp));
            $book->setPageNumber(mt_rand(10, 100));
            $book->setSummary("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
             Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
            $book->setPrice(mt_rand(10, 100));
            $book->setIsbn($this->generateRandIsbn());
            $book->setSlug(strtolower($book->getTitle()."-".$book->getId()));
            $book->setCreatedAt(new \DateTime('now'));
            $book->setUpdatedAt(new \DateTime('now'));
            $manager->persist($book);
        }

        $manager->flush();
    }

    public function generateRandIsbn()
    {
        $numbers = "0123456789";
        $result = str_pad($numbers, 13, "9876543210");
        $isbn = new Isbn($result);

        if ($isbn->isValid()) {
            // Print the code in ISBN-13 format
            return $isbn->format('ISBN-13');
        } else {
            // Show validation errors
            return $isbn->getErrors();
        }
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}