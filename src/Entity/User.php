<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $username;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\ManyToMany(targetEntity: Read::class, mappedBy: 'user')]
    private $readBook;

    #[ORM\ManyToMany(targetEntity: ToRead::class, mappedBy: 'user')]
    private $toReads;

    #[ORM\Column(type: 'string', length: 255)]
    private $gender;

    public function __construct()
    {
        $this->readBook = new ArrayCollection();
        $this->toReads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Read>
     */
    public function getReadBook(): Collection
    {
        return $this->readBook;
    }

    public function addReadBook(Read $readBook): self
    {
        if (!$this->readBook->contains($readBook)) {
            $this->readBook[] = $readBook;
            $readBook->addUser($this);
        }

        return $this;
    }

    public function removeReadBook(Read $readBook): self
    {
        if ($this->readBook->removeElement($readBook)) {
            $readBook->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ToRead>
     */
    public function getToReads(): Collection
    {
        return $this->toReads;
    }

    public function addToRead(ToRead $toRead): self
    {
        if (!$this->toReads->contains($toRead)) {
            $this->toReads[] = $toRead;
            $toRead->addUser($this);
        }

        return $this;
    }

    public function removeToRead(ToRead $toRead): self
    {
        if ($this->toReads->removeElement($toRead)) {
            $toRead->removeUser($this);
        }

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}
