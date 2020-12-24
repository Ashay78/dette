<?php


namespace App\Controller;


use App\Entity\Debt;
use App\Entity\RUserDebt;
use App\Entity\UserFake;
use App\Form\DebtAdd;
use App\Form\UserFakeAdd;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RUserDebtController extends AbstractController
{
    /**
     * @Route("/ruserdebt/{id}", name="ruserdebt")
     * @param RUserDebt $RUserDebt
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function ruserdebt(RUserDebt $RUserDebt,Request $request, EntityManagerInterface $entityManager) {

        $formFakeUserAddMoney = $this->createFormBuilder()
            ->add('amount', NumberType::class, array(
                'row_attr' => array(
                    'class' => 'form-group'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))->getForm();

        $formFakeUserAddMoney->handleRequest($request);
        if ($formFakeUserAddMoney->isSubmitted() && $formFakeUserAddMoney->isValid()) {
            $RUserDebt->setAmount($RUserDebt->getAmount() - $formFakeUserAddMoney->getData()['amount']);
            $entityManager->persist($RUserDebt);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }

        return $this->render('ruserdebt/ruserdebt.html.twig', [
            'RUserDebt' => $RUserDebt,
            'formUserAmount' => $formFakeUserAddMoney->createView()
        ]);
    }
}
