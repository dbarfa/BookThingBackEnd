<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ReadDTO
{
    #[Assert\NotNull]
    private string $book;

    private string $author;
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

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return ReadDTO
     */
    public function setAuthor(string $author): ReadDTO
    {
        $this->author = $author;
        return $this;
    }


}