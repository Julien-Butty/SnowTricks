<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TricksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trick::class);
    }


    public function findAllById()
    {
        return $this->createQueryBuilder('tricks')
            ->orderBy('tricks.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

}
