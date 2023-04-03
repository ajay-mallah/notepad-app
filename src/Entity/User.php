<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fullname = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Notepad::class)]
    private Collection $notepads;

    public function __construct()
    {
        $this->notepads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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
     * @return Collection<int, Notepad>
     */
    public function getNotepads(): Collection
    {
        return $this->notepads;
    }

    public function addNotepad(Notepad $notepad): self
    {
        if (!$this->notepads->contains($notepad)) {
            $this->notepads->add($notepad);
            $notepad->setAuthor($this);
        }

        return $this;
    }

    public function removeNotepad(Notepad $notepad): self
    {
        if ($this->notepads->removeElement($notepad)) {
            // set the owning side to null (unless already changed)
            if ($notepad->getAuthor() === $this) {
                $notepad->setAuthor(null);
            }
        }

        return $this;
    }
}
