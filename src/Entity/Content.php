<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\ContentRepository;

#[ORM\Entity(repositoryClass: ContentRepository::class)]
class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 260, unique: true)]
    #[Gedmo\Slug(fields: ['name'])]
    private $slug;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?array $files = [];

    #[ORM\ManyToOne(inversedBy: 'contents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RowTheme $rowTheme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getFiles(): ?array
    {
        return $this->files;
    }

    public function setFiles(?array $files): self
    {
        $this->files = $files;

        return $this;
    }

    public function getRowTheme(): ?RowTheme
    {
        return $this->rowTheme;
    }

    public function setRowTheme(?RowTheme $rowTheme): self
    {
        $this->rowTheme = $rowTheme;

        return $this;
    }

    /**
     * Get the value of slug
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
