<?php

namespace AdminBundle\DataFixtures;

use AdminBundle\Entity\AuthorDirector;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class AuthorDirectorFixtures extends Fixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var
     */
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
        $data = array();

        $author1 = new AuthorDirector();
        $author1->setFirstName('Jean');
        $author1->setLastName('Anouilh');

        $author2 = new AuthorDirector();
        $author2->setFirstName('Guillaume');
        $author2->setLastName('Musso');

        $author3 = new AuthorDirector();
        $author3->setFirstName('Franz-Olivier');
        $author3->setLastName('Giesbert');

        array_push($data, $author1, $author2, $author3);

        foreach ($data as $author ) {
            if (!$manager->getRepository("AdminBundle:AuthorDirector")->findOneByFullName($author->getFirstName(), $author->getLastName() )) {
                $author->setSlug($author->getFirstName().'-'.$author->getLastName());
                $author->setCreatedAt(new \DateTime('now'));
                $author->setUpdatedAt(new \DateTime('now'));
                $manager->persist($author);
                $manager->flush();
                echo 'INFO-LOG: user for  '.$author->getSlug().' is persisted !'."\r\n";
            } else {
                echo 'INFO-LOG: user already EXIST for '.$author->getSlug()."\r\n";
            }
        }
    }


    /**
     * @return int
     */
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}