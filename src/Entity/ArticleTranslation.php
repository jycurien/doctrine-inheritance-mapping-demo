<?php

namespace App\Entity;

use App\Repository\ArticleTranslationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleTranslationRepository::class)
 */
class ArticleTranslation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $locale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleTranslation;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articleTranslations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function __construct(string $locale, string $titleTranslation)
    {
        $this->locale = $locale;
        $this->titleTranslation = $titleTranslation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getTitleTranslation(): ?string
    {
        return $this->titleTranslation;
    }

    public function setTitleTranslation(string $titleTranslation): self
    {
        $this->titleTranslation = $titleTranslation;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
