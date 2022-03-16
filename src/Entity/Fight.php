<?php

namespace App\Entity;

use App\Repository\FightRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FightRepository::class)
 */
class Fight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="fights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Ligue::class, inversedBy="fights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Ligue;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $resultat;

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

    public function getResultat(): ?bool
    {
        return $this->resultat;
    }

    public function setResultat(?bool $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }
}
