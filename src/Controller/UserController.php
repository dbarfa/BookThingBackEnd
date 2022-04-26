<?php

namespace App\Controller;

use App\DTO\RegisterDTO;
use App\Mappers\UserMappers;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\ConstraintViolationList;

class UserController extends AbstractFOSRestController
{
    #[Post('/api/user')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function post(RegisterDTO                 $dto,
                         UserPasswordHasherInterface $hasher,
                         EntityManagerInterface      $em,
    )
    {

        $user = UserMappers::RegisterDTOToUser($dto, $hasher);
        $em->persist($user);
        $em->flush();
        return;
    }
}
