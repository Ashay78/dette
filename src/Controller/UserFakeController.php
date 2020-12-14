<?php
namespace App\Controller;

use App\Entity\UserFake;
use App\Form\UserFakeAdd;
use App\Repository\UserFakeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserFakeController extends AbstractController
{
    /**
     * @Route("/user/delete/{id}", name="delete_user")
     */
    public function delete($id, EntityManagerInterface $manager, ManagerRegistry $registry) {
        $userRep = new UserFakeRepository($registry);
        $user = $userRep->find($id);

        if(is_null($user)){return $this->redirectToRoute('admin');}

        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('admin');
    }

}

