<?php

namespace App\Controller;

use App\Entity\Debt;
use App\Entity\UserFake;
use App\Entity\RUserDebt;
use App\Entity\UserToUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function homepage(EntityManagerInterface $entityManager)
    {
        $repositoryUserFake = $entityManager->getRepository(UserFake::class);
        $users = $repositoryUserFake->findAll();

        $repositoryDebt = $entityManager->getRepository(Debt::class);
        $debts = $repositoryDebt->findAll();

        $repositoryRUserDebt = $entityManager->getRepository(RUserDebt::class);

        $recevoir = 0;
        $donner = 0;

        /** @var UserFake|null $myUser */
        $myUser = $repositoryUserFake->findOneBy([
            'firstName' => 'Gabriel',
            'lastName' => 'Cousin'
        ]);

        $userToUsers = $repositoryRUserDebt->getAllUserToUser();

        /** @var UserToUser $userToUser */
        foreach ($userToUsers as $userToUser) {
            if ($userToUser->getFirstUser()->getId() === $myUser->getId()) {
                $recevoir += $userToUser->getAmount();
            }

            if($userToUser->getSecondUser()->getId() === $myUser->getId()) {
                $donner += $userToUser->getAmount();
            }
        }

        return $this->render('home/homepage.html.twig', [
            'users' => $users,
            'debts' => $debts,
            'recevoir' => $recevoir,
            'donner' => $donner,
            'userToUsers' => $userToUsers,
            'myUser' => $myUser
        ]);
    }
}
