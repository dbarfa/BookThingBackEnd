<?php

namespace App\Mappers;

use App\DTO\RegisterDTO;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserMappers
{
    public static function RegisterDTOToUser(RegisterDTO                 $dto,
                                             UserPasswordHasherInterface $hasher) : User
    {
        $user = new User();
        $user->setUsername($dto->getUsername());
        $user->setPassword($hasher->hashPassword($user, $dto->getPassword()));
        $user->setEmail($dto->getEmail());
        $user->setRoles(['ROLE_USER']);
        $user->setGender($dto->getGender());
        return $user;
    }
}