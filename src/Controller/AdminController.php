<?php
namespace App\Controller;

use App\Entity\Debt;
use App\Entity\UserFake;
use App\Form\Type\DebtAdd;
use App\Form\Type\UserFakeAdd;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @return Response
     */
    public function homepage(Request $request, EntityManagerInterface $entityManager) {
        $repositoryUserFake = $entityManager->getRepository(UserFake::class);
        $users = $repositoryUserFake->findAll();

        $repositoryDebt = $entityManager->getRepository(Debt::class);
        $debts = $repositoryDebt->findAll();

        $user = new UserFake();
        $debt = new Debt();

        $formAddUser = $this->createForm(UserFakeAdd::class, $user);
        $formAddDebt = $this->createForm(DebtAdd::class, $debt);

        /** @var UserFake|null $myUser */
        $myUser = $repositoryUserFake->findOneBy([
            'firstName' => 'Gabriel',
            'lastName' => 'Cousin'
        ]);

        $formAddUser->handleRequest($request);
        if ($formAddUser->isSubmitted() && $formAddUser->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        $formAddDebt->handleRequest($request);
        if ($formAddDebt->isSubmitted() && $formAddDebt->isValid()) {
            $userReceive = $repositoryUserFake->find($debt->getUserReceives());
            $userReceive->addDebt($debt);

            $entityManager->persist($debt);
            $entityManager->persist($userReceive);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/admin.html.twig', [
            'formAddUser' => $formAddUser->createView(),
            'formAddDebt' => $formAddDebt->createView(),
            'users' => $users,
            'debts' => $debts,
            'myUser' => $myUser
        ]);
    }

    /**
     * @Route("/user/update/{id}", name="update_user")
     */
    public function updateUser(UserFake $user, EntityManagerInterface $entityManager, ManagerRegistry $registry) {
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/user/delete/{id}", name="delete_user")
     */
    public function deleteUser(UserFake $user, EntityManagerInterface $entityManager, ManagerRegistry $registry) {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }


}
