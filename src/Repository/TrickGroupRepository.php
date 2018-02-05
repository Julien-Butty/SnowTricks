<?php

namespace App\Repository;

use App\Entity\TrickGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TrickGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrickGroup::class);
    }


    public function AlphabeticalOrder()
    {
        return $this->createQueryBuilder('trick_group')
            ->orderBy('trick_group.name', 'ASC');

    }

}
