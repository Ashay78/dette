<?php


namespace App\Controller;


use App\Entity\Debt;
use App\Entity\RUserDebt;
use App\Entity\UserFake;
use App\Form\Type\DebtAdd;
use App\Form\Type\RUserDebtAdd;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DebtController extends AbstractController
{
    /**
     * @Route("/debt/{id}", name="debt")
     * @return Response
     */
    public function page(Debt $debt, Request $request, EntityManagerInterface $entityManager)
    {
        $formUpdateDebt = $this->createForm(DebtAdd::class, $debt);

        $RUserDebt = new RUserDebt();
        $formAddRUserDebt = $this->createForm(RUserDebtAdd::class, $RUserDebt);

        $formUpdateDebt->handleRequest($request);
        if ($formUpdateDebt->isSubmitted() && $formUpdateDebt->isValid()) {
            $entityManager->persist($debt);
            $entityManager->flush();
        }

        $formAddRUserDebt->handleRequest($request);
        if ($formAddRUserDebt->isSubmitted() && $formAddRUserDebt->isValid()) {
            if(!$debt->getIsSubscription()) {
                $RUserDebt->setMonthSubscription(null);
            }
            $user = $entityManager->find(UserFake::class, $RUserDebt->getUserOwe());
            $user->addRUserDebt($RUserDebt);
            $debt->addRUserDebt($RUserDebt);
            $RUserDebt->setDebt($debt);

            $entityManager->persist($user);
            $entityManager->persist($debt);
            $entityManager->persist($RUserDebt);
            $entityManager->flush();
        }

        return $this->render('Debt/debt.html.twig', [
            'debt' => $debt,
            'formUpdateDebt' => $formUpdateDebt->createView(),
            'formAddRUserDebt' => $formAddRUserDebt->createView()
        ]);
    }

    /**
     * @Route("/debt/update/{id}", name="debt_update")
     * @return Response
     */
    public function updateDebt(Debt $debt, Request $request, EntityManagerInterface $entityManager)
    {
        $entityManager->persist($debt);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/debt/delete/{id}", name="debt_delete")
     * @return Response
     */
    public function deleteDebt(Debt $debt, Request $request, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($debt);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/RUserDebt/delete/{id}", name="RUserDebt_delete")
     * @return Response
     */
    public function deleteRUserDebt(RUserDebt $RUserDebt, Request $request, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($RUserDebt);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }
}
