<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingRepository::class)]
class Training
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'trainings')]
    private Collection $categories;

    #[ORM\Column(nullable: true)]
    private ?bool $isCpf = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $duration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $prerequis = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $presentation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cpfLink = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $objectif = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $certificate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $strength = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resources = null;

    #[ORM\Column(nullable: true)]
    private ?array $faq = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modality = null;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'relatedTrainings')]
    private Collection $trainings;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'trainings')]
    private Collection $relatedTrainings;

    #[ORM\Column(nullable: true)]
    private ?bool $isHome = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isFree = null;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->trainings = new ArrayCollection();
        $this->relatedTrainings = new ArrayCollection();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function isIsCpf(): ?bool
    {
        return $this->isCpf;
    }

    public function setIsCpf(?bool $isCpf): static
    {
        $this->isCpf = $isCpf;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(?string $prerequis): static
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getCpfLink(): ?string
    {
        return $this->cpfLink;
    }

    public function setCpfLink(?string $cpfLink): static
    {
        $this->cpfLink = $cpfLink;

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): static
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getCertificate(): ?string
    {
        return $this->certificate;
    }

    public function setCertificate(?string $certificate): static
    {
        $this->certificate = $certificate;

        return $this;
    }

    public function getStrength(): ?string
    {
        return $this->strength;
    }

    public function setStrength(?string $strength): static
    {
        $this->strength = $strength;

        return $this;
    }

    public function getResources(): ?string
    {
        return $this->resources;
    }

    public function setResources(?string $resources): static
    {
        $this->resources = $resources;

        return $this;
    }

    public function getFaq(): ?array
    {
        return $this->faq;
    }

    public function setFaq(?array $faq): static
    {
        $this->faq = $faq;

        return $this;
    }

    public function getModality(): ?string
    {
        return $this->modality;
    }

    public function setModality(?string $modality): static
    {
        $this->modality = $modality;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(self $training): static
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings->add($training);
        }

        return $this;
    }

    public function removeTraining(self $training): static
    {
        $this->trainings->removeElement($training);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRelatedTrainings(): Collection
    {
        return $this->relatedTrainings;
    }

    public function addRelatedTraining(self $relatedTraining): static
    {
        if (!$this->relatedTrainings->contains($relatedTraining)) {
            $this->relatedTrainings->add($relatedTraining);
            $relatedTraining->addTraining($this);
        }

        return $this;
    }

    public function removeRelatedTraining(self $relatedTraining): static
    {
        if ($this->relatedTrainings->removeElement($relatedTraining)) {
            $relatedTraining->removeTraining($this);
        }

        return $this;
    }

    public function isIsHome(): ?bool
    {
        return $this->isHome;
    }

    public function setIsHome(?bool $isHome): static
    {
        $this->isHome = $isHome;

        return $this;
    }

    public function isIsFree(): ?bool
    {
        return $this->isFree;
    }

    public function setIsFree(?bool $isFree): static
    {
        $this->isFree = $isFree;

        return $this;
    }
}
