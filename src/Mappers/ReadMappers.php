<?php

namespace App\Mappers;

use App\DTO\ReadDTO;
use App\Entity\Read;

class ReadMappers
{
    public static function PostRead(ReadDTO $dto, $userdata): Read
    {
        $user = $userdata;
        $read = new Read();
        $read->setWorksId($dto->getBook());
        $read->addUser($user);
        return $read;
    }
}