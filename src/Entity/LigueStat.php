<?php

namespace App\Entity;

use App\Repository\LigueStatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigueStatRepository::class)
 */
class LigueStat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ligueStats")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Ligue::class, inversedBy="ligueStats")
     */
    private $Ligue;

    /**
     * @ORM\Column(type="integer")
     */
    private $Defaite;

    /**
     * @ORM\Column(type="integer")
     */
    private $Victoire;

    /**
     * @ORM\Column(type="float")
     */
    private $TauxVictoire;



    public function __construct()
    {
        $this->User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getLigue(): ?Ligue
    {
        return $this->Ligue;
    }

    public function setLigue(?Ligue $Ligue): self
    {
        $this->Ligue = $Ligue;

        return $this;
    }

    public function getDefaite(): ?int
    {
        return $this->Defaite;
    }

    public function setDefaite(int $Defaite): self
    {
        $this->Defaite = $Defaite;

        return $this;
    }

    public function getVictoire(): ?int
    {
        return $this->Victoire;
    }

    public function setVictoire(int $Victoire): self
    {
        $this->Victoire = $Victoire;

        return $this;
    }

    public function getTauxVictoire(): ?float
    {
        return $this->TauxVictoire;
    }

    public function setTauxVictoire(float $TauxVictoire): self
    {
        $this->TauxVictoire = $TauxVictoire;

        return $this;
    }


}
