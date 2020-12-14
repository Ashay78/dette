<?php

namespace App\Repository;

use App\Entity\RUserDebt;
use App\Entity\UserToUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RUserDebt|null find($id, $lockMode = null, $lockVersion = null)
 * @method RUserDebt|null findOneBy(array $criteria, array $orderBy = null)
 * @method RUserDebt[]    findAll()
 * @method RUserDebt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RUserDebtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RUserDebt::class);
    }

    /**
     * @return UserToUser[]
     */
    public function getAllUserToUser(): array
    {
        $userToUsers = array();
        $RUserDebts = $this->findAll();
        foreach ($RUserDebts as $RUserDebt) {
            $find = false;
            /** @var UserToUser $userToUser */
            foreach ($userToUsers as $userToUser) {
                if ($userToUser->getFirstUser()->getId() === $RUserDebt->getDebt()->getUserReceives()->getId() && $userToUser->getSecondUser()->getId() === $RUserDebt->getUserOwe()->getId()) {
                    $userToUser->setAmount($userToUser->getAmount() + $RUserDebt->getAmount());
                    $find = true;
                }
            }
            if (!$find) {
                $res = new UserToUser();
                $res->setFirstUser($RUserDebt->getDebt()->getUserReceives());
                $res->setSecondUser($RUserDebt->getUserOwe());
                $res->setAmount($RUserDebt->getAmount());
                $userToUsers[] = $res;
            }
        }
        return $userToUsers;
    }

    /*
    public function findOneBySomeField($value): ?RUserDebt
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
