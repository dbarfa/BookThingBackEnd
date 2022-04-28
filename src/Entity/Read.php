<?php

namespace App\Entity;

use App\Repository\ReadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReadRepository::class)]
#[ORM\Table(name: '`read`')]
class Read
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255,unique: true)]
    private $worksId;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'readBook')]
    private $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getWorksId(): ?string
    {
        return $this->worksId;
    }

    public function setWorksId(string $worksId): self
    {
        $this->worksId = $worksId;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }
}
