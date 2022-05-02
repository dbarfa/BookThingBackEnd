<?php

namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class ToReadDTO
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
     * @return ToReadDTO
     */
    public function setBook(string $book): ToReadDTO
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
     * @return ToReadDTO
     */
    public function setAuthor(string $author): ToReadDTO
    {
        $this->author = $author;
        return $this;
    }



}