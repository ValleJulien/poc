<?php

namespace AdminBundle\DataFixtures;

use AdminBundle\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Biblys\Isbn\Isbn as Isbn;

class ActorFixtures extends Fixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $actors = array(
            array('Leonardo', 'Dicaprio'),
            array('Jean', 'Dujardin'),
            array('Edward', 'Norton'),
            array('Jack', 'Nicholson'),
            array('Robert', 'De Niro')
        );

        foreach ($actors as $actor)
        {
            $result = new Actor();
            $result->setFisrtName($actor[0]);
            $result->setLastName($actor[1]);
            $result->setCreatedAt(new \DateTime('now'));
            $result->setUpdatedAt(new \DateTime('now'));
            $result->setSlug($result->getFisrtName()."-".$result->getLastName());
            $manager->persist($result);
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
        return 2;
    }
}