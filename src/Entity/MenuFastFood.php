<?php

namespace App\Entity;

use App\Repository\MenuFastFoodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuFastFoodRepository::class)
 */
class MenuFastFood
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $pritUnitaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $promotion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixPromotion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPritUnitaire(): ?int
    {
        return $this->pritUnitaire;
    }

    public function setPritUnitaire(int $pritUnitaire): self
    {
        $this->pritUnitaire = $pritUnitaire;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPromotion(): ?bool
    {
        return $this->promotion;
    }

    public function setPromotion(?bool $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getPrixPromotion(): ?int
    {
        return $this->prixPromotion;
    }

    public function setPrixPromotion(?int $prixPromotion): self
    {
        $this->prixPromotion = $prixPromotion;

        return $this;
    }
}
