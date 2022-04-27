<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ReadDTO
{
    #[Assert\NotNull]
    private string $book;

    #[Assert\NotNull]
    private string $username;

}