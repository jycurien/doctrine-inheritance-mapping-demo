<?php

namespace App\Entity;

use App\Repository\ArticleContentTranslationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleContentTranslationRepository::class)
 */
class ArticleContentTranslation
{
    use TranslationTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    public function __construct(string $locale, string $content)
    {
        $this->locale = $locale;
        $this->content = $content;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
