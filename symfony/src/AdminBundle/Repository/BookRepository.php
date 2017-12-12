<?php

namespace AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;


class BookRepository extends EntityRepository
{
    /**
     * @param int $count
     * @return array
     */
    public function getLastRegisteredBook(int $count)
    {
        $queryBuilder = $this->_em->createQueryBuilder();
        return $queryBuilder
            ->select('b')
            ->from('AdminBundle:Book', 'b')
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery()
            ->setMaxResults($count)
            ->getResult();
    }
}