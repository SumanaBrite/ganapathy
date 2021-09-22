<?php

namespace App\Entity;

use App\Repository\ArticleFastFoodMenuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleFastFoodMenuRepository::class)
 */
class ArticleFastFoodMenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MenuFastFood::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity=ArticleFastFood::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenu(): ?MenuFastFood
    {
        return $this->menu;
    }

    public function setMenu(?MenuFastFood $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getArticle(): ?ArticleFastFood
    {
        return $this->article;
    }

    public function setArticle(?ArticleFastFood $article): self
    {
        $this->article = $article;

        return $this;
    }
}
