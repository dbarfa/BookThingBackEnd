<?php

namespace App\Mappers;

use App\DTO\ToReadDTO;
use App\Entity\ToRead;

class ToReadMappers
{
    public static function PostToRead(ToReadDTO $dto, $userdata): ToRead
    {
        $user = $userdata;
        $toRead = new ToRead();
        $toRead->setWorksId($dto->getBook());
        $toRead->setAuthor($dto->getAuthor());
        $toRead->addUser($user);
        return $toRead;
    }
}