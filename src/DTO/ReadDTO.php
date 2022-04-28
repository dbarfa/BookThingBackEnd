<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ReadDTO
{
    #[Assert\NotNull]
    private string $book;


    /**
     * @return string
     */
    public function getBook(): string
    {
        return $this->book;
    }

    /**
     * @param string $book
     * @return ReadDTO
     */
    public function setBook(string $book): ReadDTO
    {
        $this->book = $book;
        return $this;
    }


}