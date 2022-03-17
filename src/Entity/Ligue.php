<?php

namespace App\Entity;

use App\Repository\LigueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigueRepository::class)
 */
class Ligue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $Created_at;


    /**
     * @ORM\OneToMany(targetEntity=Fight::class, mappedBy="Ligue", orphanRemoval=true)
     */
    private $fights;

    /**
     * @ORM\OneToMany(targetEntity=LigueStat::class, mappedBy="Ligue")
     */
    private $ligueStats;


    public function __construct()
    {
        $this->User = new ArrayCollection();
        $this->fights = new ArrayCollection();
        $this->ligueStats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->Created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $Created_at): self
    {
        $this->Created_at = $Created_at;

        return $this;
    }



    /**
     * @return Collection<int, Fight>
     */
    public function getFights(): Collection
    {
        return $this->fights;
    }

    public function addFight(Fight $fight): self
    {
        if (!$this->fights->contains($fight)) {
            $this->fights[] = $fight;
            $fight->setLigue($this);
        }

        return $this;
    }

    public function removeFight(Fight $fight): self
    {
        if ($this->fights->removeElement($fight)) {
            // set the owning side to null (unless already changed)
            if ($fight->getLigue() === $this) {
                $fight->setLigue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LigueStat>
     */
    public function getLigueStats(): Collection
    {
        return $this->ligueStats;
    }

    public function addLigueStat(LigueStat $ligueStat): self
    {
        if (!$this->ligueStats->contains($ligueStat)) {
            $this->ligueStats[] = $ligueStat;
            $ligueStat->setLigue($this);
        }

        return $this;
    }

    public function removeLigueStat(LigueStat $ligueStat): self
    {
        if ($this->ligueStats->removeElement($ligueStat)) {
            // set the owning side to null (unless already changed)
            if ($ligueStat->getLigue() === $this) {
                $ligueStat->setLigue(null);
            }
        }

        return $this;
    }


}
