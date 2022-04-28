<?php

namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class ToReadDTO
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
     * @return ToReadDTO
     */
    public function setBook(string $book): ToReadDTO
    {
        $this->book = $book;
        return $this;
    }



}