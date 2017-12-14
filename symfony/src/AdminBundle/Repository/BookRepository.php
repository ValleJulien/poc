<?php

namespace AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;


class BookRepository extends EntityRepository
{
    /**
     * @param int $counter
     * @return array
     */
    public function getLastRegisteredBook(int $counter = null)
    {
        $queryBuilder = $this->_em->createQueryBuilder();
        return $queryBuilder
            ->select('b')
            ->from('AdminBundle:Book', 'b')
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery()
            ->setMaxResults($counter)
            ->getResult();
    }
}