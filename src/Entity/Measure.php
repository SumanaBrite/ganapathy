<?php

namespace App\Entity;

use App\Repository\MeasureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeasureRepository::class)
 */
class Measure
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
     * @ORM\OneToMany(targetEntity=ArticleBoucherie::class, mappedBy="unit")
     */
    private $articleBoucheries;

    public function __construct()
    {
        $this->articleBoucheries = new ArrayCollection();
    }

    
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

    /**
     * @return Collection|ArticleBoucherie[]
     */
    public function getArticleBoucheries(): Collection
    {
        return $this->articleBoucheries;
    }

    public function addArticleBouchery(ArticleBoucherie $articleBouchery): self
    {
        if (!$this->articleBoucheries->contains($articleBouchery)) {
            $this->articleBoucheries[] = $articleBouchery;
            $articleBouchery->setUnit($this);
        }

        return $this;
    }

    public function removeArticleBouchery(ArticleBoucherie $articleBouchery): self
    {
        if ($this->articleBoucheries->removeElement($articleBouchery)) {
            // set the owning side to null (unless already changed)
            if ($articleBouchery->getUnit() === $this) {
                $articleBouchery->setUnit(null);
            }
        }

        return $this;
    }

    
}
