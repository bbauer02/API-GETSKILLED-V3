<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssessmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssessmentRepository::class)]
#[ApiResource]
class Assessment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, InstituteAssessmentOwnership>
     */
    #[ORM\OneToMany(targetEntity: InstituteAssessmentOwnership::class, mappedBy: 'assessment', orphanRemoval: true)]
    private Collection $instituteAssessmentOwnerships;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 10)]
    private ?string $ref = null;

    #[ORM\Column]
    private ?bool $isInternal = null;

    // Côté enfant : chaque Assessment a 0 ou 1 parent
    #[ORM\ManyToOne(
        targetEntity: self::class,
        inversedBy: 'children'
    )]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?self $parent = null;

    // Côté parent : un Assessment peut avoir plusieurs enfants
    /** @var Collection<int, self> */
    #[ORM\OneToMany(
        targetEntity: self::class,
        mappedBy: 'parent',
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $children;

    /**
     * @var Collection<int, Level>
     */
    #[ORM\ManyToMany(targetEntity: Level::class)]
    private Collection $levels;
    public function __construct()
    {
        $this->instituteAssessmentOwnerships = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->levels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, InstituteAssessmentOwnership>
     */
    public function getInstituteAssessmentOwnerships(): Collection
    {
        return $this->instituteAssessmentOwnerships;
    }

    public function addInstituteAssessmentOwnership(InstituteAssessmentOwnership $instituteAssessmentOwnership): static
    {
        if (!$this->instituteAssessmentOwnerships->contains($instituteAssessmentOwnership)) {
            $this->instituteAssessmentOwnerships->add($instituteAssessmentOwnership);
            $instituteAssessmentOwnership->setAssessment($this);
        }

        return $this;
    }

    public function removeInstituteAssessmentOwnership(InstituteAssessmentOwnership $instituteAssessmentOwnership): static
    {
        if ($this->instituteAssessmentOwnerships->removeElement($instituteAssessmentOwnership)) {
            // set the owning side to null (unless already changed)
            if ($instituteAssessmentOwnership->getAssessment() === $this) {
                $instituteAssessmentOwnership->setAssessment(null);
            }
        }

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function isInternal(): ?bool
    {
        return $this->isInternal;
    }

    public function setIsInternal(bool $isInternal): static
    {
        $this->isInternal = $isInternal;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChildren(): Collection { return $this->children; }

    public function addChild(self $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }
        return $this;
    }

    public function removeChild(self $child): static
    {
        if ($this->children->removeElement($child) && $child->getParent() === $this) {
            $child->setParent(null);
        }
        return $this;
    }

    /**
     * @return Collection<int, Level>
     */
    public function getLevels(): Collection
    {
        return $this->levels;
    }

    public function addLevel(Level $level): static
    {
        if (!$this->level->contains($level)) {
            $this->level->add($level);
        }

        return $this;
    }

    public function removeLevel(Level $level): static
    {
        $this->level->removeElement($level);

        return $this;
    }

    public function getAllLevels(): Collection
    {
        $all = new ArrayCollection($this->levels->toArray());
        if ($this->parent) {
            foreach ($this->parent->getAllLevels() as $lvl) {
                if (!$all->contains($lvl)) {
                    $all->add($lvl);
                }
            }
        }
        return $all;
    }


}
