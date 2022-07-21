<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentsRepository;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private $contenu = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'comments', targetEntity: Publications::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $publication = null;

    #[ORM\ManyToOne(inversedBy: 'comments', targetEntity: Users::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user = null;

    public function __toString()
    {
        return $this->contenu;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPublication(): ?Publications
    {
        return $this->publication;
    }

    public function setPublication(?Publications $publication): self
    {
        $this->publication = $publication;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }
}