<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('gab-cousin@hotmail.fr');
        $user->setRoles(array('ROLE_SUPER_ADMIN'));
        $password = $this->encoder->encodePassword($user, 'TQJBXkxRu92Trv7b');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
    }
}
