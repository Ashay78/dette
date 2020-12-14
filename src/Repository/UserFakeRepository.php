<?php

namespace App\Repository;

use App\Entity\UserFake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserFake|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFake|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFake[]    findAll()
 * @method UserFake[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFake::class);
    }

    // /**
    //  * @return UserFake[] Returns an array of UserFake objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
