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

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $books = [
            "L'Insoutenable Légèreté de l'être",
            "J'irai cracher sur vos tombes",
            "Voyage au bout de la nuit",
            "L'Écume des jours",
            "Le numéro 23",
            "L'ordre du jour",
            "La disparition de josef mengele",
            "On la trouvait plutot jolie",
            "La reine du bal",
            "Congo Requiem",
            "Poupée volée",
            "Dieu n'habite pas la Havane",
            "Une bouche sans personne"
        ];

        $authors = $manager->getRepository("AdminBundle:AuthorDirector")->findAll();

        // create 10 books!
        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book->setId($i);
            $randomTitle = array_rand($books);
            $book->setTitle($books[$randomTitle]);
            $book->setPublishedAt(date("Y-m-d", mt_rand(1, time()) ));
            $book->setPageNumber(mt_rand(100, 300));
            $book->setSummary("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
             Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
            $book->setPrice(mt_rand(10, 100));
            $book->setIsbn($this->generateRandIsbn());
            $book->setSlug(preg_replace('/\s+/', '-', strtolower($book->getTitle()."-".$book->getId())));
            $book->setCreatedAt(new \DateTime('now'));
            $book->setUpdatedAt(new \DateTime('now'));
            $book->setAuthorDirector($authors[rand(0, count($authors) -1)]);
            $manager->persist($book);
            echo 'INFO-LOG: book with title  '.$book->getTitle().' write by '.$book->getAuthorDirector().' is persisted !'."\r\n";
        }

        $manager->flush();
    }


    /**
     * @return string
     */
    public function generateRandIsbn()
    {
        $result = str_pad(mt_rand(0, mt_getrandmax()), 13, mt_rand(0, mt_getrandmax()), STR_PAD_BOTH);
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