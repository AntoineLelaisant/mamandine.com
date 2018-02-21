<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Cake;

class CakeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cake::class);
    }

    public function search(string $q = null)
    {
        if (null === $q) {
            return $this->findAll();
        }

        return $this
            ->createQueryBuilder('cake')
            ->addSelect('cake.categories')
            ->where('LOWER(cake.name) LIKE LOWER(:q)')
            ->setParameter('q', "%$q%")
            ->getQuery()
            ->getResult()
        ;
    }
}
