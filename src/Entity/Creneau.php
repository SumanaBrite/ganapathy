<?php

namespace App\Entity;

use App\Repository\CreneauRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreneauRepository::class)
 */
class Creneau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $champ;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChamp(): ?string
    {
        return $this->champ;
    }

    public function setChamp(string $champ): self
    {
        $this->champ = $champ;

        return $this;
    }
}
