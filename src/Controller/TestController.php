<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em): Response
    {

        $user1 = new User();
        $user1->setUsername('Khun');
        $user1->setRoles(['ROLE_USER',
        ]);
        $user1->setPassword($userPasswordHasher->hashPassword($user1,'test123'));
        $user1->setEmail('khun@khun.com');
        $user2 = new User();
        $user2->setUsername('Fatima');
        $user2->setRoles(['ROLE_USER',
        ]);
        $user2->setPassword($userPasswordHasher->hashPassword($user2,'test123'));
        $user2->setEmail('Fatima@Fatima.com');

        $em->persist($user1);
        $em->persist($user2);
        $em->flush();
        return new JsonResponse(['response'=>'ok']);

    }
}
