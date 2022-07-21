<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private $nom = null;

    #[ORM\Column(type: Types::STRING, length: 128)]
    private $slug = null;

    #[ORM\Column(type: Types::STRING, length: 15)]
    private $couleur = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private $description = null;

    #[ORM\ManyToMany(targetEntity: Publications::class, mappedBy: 'categorie')]
    private $publications;


    public function __construct()
    {
        $this->publication = new ArrayCollection();
        $this->publications = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Publications>
     */

    /**
     * @return Collection<int, Publications>
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publications $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications[] = $publication;
            $publication->addCategorie($this);
        }

        return $this;
    }

    public function removePublication(Publications $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            $publication->removeCategorie($this);
        }

        return $this;
    }
}