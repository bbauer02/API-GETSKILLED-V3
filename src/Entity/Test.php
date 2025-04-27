<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
#[ApiResource(
    shortName: 'Assessment',
    routePrefix: '/assessments'
)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 10)]
    private ?string $ref = null;

    #[ORM\Column]
    private ?bool $isInternal = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Test $parent = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent', cascade: ['persist', 'remove'])]
    private Collection $children;

    /**
     * @var Collection<int, InstitutTestOwnership>
     */
    #[ORM\OneToMany(targetEntity: InstitutTestOwnership::class, mappedBy: 'test', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $institutTestOwnerships;

    /**
     * @var Collection<int, Level>
     */
    #[ORM\OneToMany(targetEntity: Level::class, mappedBy: 'test', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $levels;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->institutTestOwnerships = new ArrayCollection();
        $this->levels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getParent(): ?Test
    {
        return $this->parent;
    }

    public function setParent(?Test $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, Test>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Test $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(Test $child): static
    {
        if ($this->children->removeElement($child)) {
            if ($child->getParent() === $this) {
                $child->setParent($this); // attention : ici je force la relation, sinon la base peut planter sur NOT NULL
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InstitutTestOwnership>
     */
    public function getInstitutTestOwnerships(): Collection
    {
        return $this->institutTestOwnerships;
    }

    public function addInstitutTestOwnership(InstitutTestOwnership $institutTestOwnership): static
    {
        if (!$this->institutTestOwnerships->contains($institutTestOwnership)) {
            $this->institutTestOwnerships->add($institutTestOwnership);
            $institutTestOwnership->setTest($this);
        }

        return $this;
    }

    public function removeInstitutTestOwnership(InstitutTestOwnership $institutTestOwnership): static
    {
        if ($this->institutTestOwnerships->removeElement($institutTestOwnership)) {
            // set the owning side to null (unless already changed)
            if ($institutTestOwnership->getTest() === $this) {
                $institutTestOwnership->setTest(null);
            }
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
        if (!$this->levels->contains($level)) {
            $this->levels->add($level);
            $level->setTest($this);
        }

        return $this;
    }

    public function removeLevel(Level $level): static
    {
        if ($this->levels->removeElement($level)) {
            // set the owning side to null (unless already changed)
            if ($level->getTest() === $this) {
                $level->setTest(null);
            }
        }

        return $this;
    }
}
