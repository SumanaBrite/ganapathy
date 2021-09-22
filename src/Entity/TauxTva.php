<?php

namespace App\Entity;

use App\Repository\TauxTvaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TauxTvaRepository::class)
 */
class TauxTva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $taux;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaux(): ?int
    {
        return $this->taux;
    }

    public function setTaux(int $taux): self
    {
        $this->taux = $taux;

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
}
