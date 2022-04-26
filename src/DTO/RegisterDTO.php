<?php

namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;
class RegisterDTO
{
    #[Assert\NotNull]
    private string $username;
    #[Assert\NotNull]
    private string $password;
    #[Assert\NotNull]
    private string $email;

    #[Assert\NotNull]
    private string $gender;
    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return RegisterDTO
     */
    public function setUsername(string $username): RegisterDTO
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return RegisterDTO
     */
    public function setPassword(string $password): RegisterDTO
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return RegisterDTO
     */
    public function setEmail(string $email): RegisterDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return RegisterDTO
     */
    public function setGender(string $gender): RegisterDTO
    {
        $this->gender = $gender;
        return $this;
    }



}