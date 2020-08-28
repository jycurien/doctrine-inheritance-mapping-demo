<?php

namespace App\Entity;

use App\Repository\ArticleContentTranslationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleContentTranslationRepository::class)
 */
class ArticleContentTranslation
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
     * @ORM\Column(type="text")
     */
    private $contentTranslation;

    public function __construct(string $locale, string $contentTranslation)
    {
        $this->locale = $locale;
        $this->contentTranslation = $contentTranslation;
    }

    /**
     * @ORM\ManyToOne(targetEntity=ArticleContent::class, inversedBy="articleContentTranslations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $articleContent;

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

    public function getContentTranslation(): ?string
    {
        return $this->contentTranslation;
    }

    public function setContentTranslation(string $contentTranslation): self
    {
        $this->contentTranslation = $contentTranslation;

        return $this;
    }

    public function getArticleContent(): ?ArticleContent
    {
        return $this->articleContent;
    }

    public function setArticleContent(?ArticleContent $articleContent): self
    {
        $this->articleContent = $articleContent;

        return $this;
    }
}
