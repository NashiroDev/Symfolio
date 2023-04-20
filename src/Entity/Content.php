<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'contents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RowTheme $rowTheme = null;

    #[ORM\OneToMany(mappedBy: 'content', targetEntity: ContentFile::class, orphanRemoval: true, cascade:['persist'])]
    private Collection $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ContentFile>
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(ContentFile $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files->add($file);
            $file->setContent($this);
        }

        return $this;
    }

    public function removeFile(ContentFile $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getContent() === $this) {
                $file->setContent(null);
            }
        }

        return $this;
    }
}
