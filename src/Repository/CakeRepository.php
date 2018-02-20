<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class CakeRepository extends EntityRepository
{
    public function search(string $q = null)
    {
        if (null === $q) {
            return $this->findAll();
        }

        return $this
            ->createQueryBuilder('cake')
            ->where('LOWER(cake.name) LIKE LOWER(:q)')
            ->setParameter('q', "%$q%")
            ->getQuery()
            ->getResult()
        ;
    }
}
