<?php

namespace App\Repository;

use App\Entity\HasVoted;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HasVoted|null find($id, $lockMode = null, $lockVersion = null)
 * @method HasVoted|null findOneBy(array $criteria, array $orderBy = null)
 * @method HasVoted[]    findAll()
 * @method HasVoted[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HasVotedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HasVoted::class);
    }

    // /**
    //  * @return HasVoted[] Returns an array of HasVoted objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HasVoted
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
