<?php

namespace App\Entity;

use App\Repository\ArticleFastFoodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleFastFoodRepository::class)
 */
class ArticleFastFood
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
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prixUnitaire;

    /**
     * @ORM\ManyToOne(targetEntity=UniteFastFood::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $promotion;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $prixPromotion;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieFastFood::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=TauxTva::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $tva;

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

    public function getPrixUnitaire(): ?string
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(string $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getUnit(): ?UniteFastFood
    {
        return $this->unit;
    }

    public function setUnit(?UniteFastFood $unit): self
    {
        $this->unit = $unit;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getPrixPromotion(): ?string
    {
        return $this->prixPromotion;
    }

    public function setPrixPromotion(?string $prixPromotion): self
    {
        $this->prixPromotion = $prixPromotion;

        return $this;
    }

    public function getCategorie(): ?CategorieFastFood
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieFastFood $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getTva(): ?TauxTva
    {
        return $this->tva;
    }

    public function setTva(?TauxTva $tva): self
    {
        $this->tva = $tva;

        return $this;
    }
}
