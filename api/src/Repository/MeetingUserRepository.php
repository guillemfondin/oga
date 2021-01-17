<?php

namespace App\Repository;

use App\Entity\MeetingUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeetingUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeetingUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeetingUser[]    findAll()
 * @method MeetingUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeetingUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeetingUser::class);
    }

    // /**
    //  * @return MeetingUser[] Returns an array of MeetingUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MeetingUser
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
