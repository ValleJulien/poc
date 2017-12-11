<?php

namespace AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;


class AuthorDirectorRepository extends EntityRepository
{
    /**
     * @param $firstName
     * @param $lastName
     * @return array
     */
    public function findOneByFullName($firstName, $lastName)
    {
        $queryBuilder = $this->_em->createQueryBuilder();
        $queryBuilder
            ->select('partial ad.{id}')
            ->from('AdminBundle:AuthorDirector', 'ad')
            ->where('ad.firstName = :firstName', 'ad.lastName = :lastName')
            ->setParameters(
                array(
                    'firstName' => $firstName,
                    'lastName'  => $lastName,
                ));

        return $queryBuilder->getQuery()
                            ->getResult();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function selectRandomAuthorDirector()
    {
        $queryBuilder = $this->_em->createQueryBuilder();
        $queryBuilder
            ->select('partial ad.{id}')
            ->addSelect('RAND() as HIDDEN rand')
            ->from('AdminBundle:AuthorDirector', 'ad')
            ->orderBy('rand');

        return $queryBuilder->getQuery()
                            ->getSingleResult();
    }
}