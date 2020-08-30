<?php

namespace App\Entity;

use App\Repository\ArticleContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

/**
 * @ORM\Entity(repositoryClass=ArticleContentRepository::class)
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="content_type", type="string")
 * @DiscriminatorMap({
 *     "text" = "ArticleContent",
 *     "markdown" = "MarkdownContent",
 *     "code" = "CodeContent",
 *     "image" = "ImageContent",
 *     "github" = "GithubContent",
 * })
 */
class ArticleContent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articleContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity=ArticleContentTranslation::class, mappedBy="articleContent",
     *     orphanRemoval=true, indexBy="locale", cascade={"persist"})
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return Collection|ArticleContentTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(ArticleContentTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setArticleContent($this);
        }

        return $this;
    }

    public function removeTranslation(ArticleContentTranslation $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getArticleContent() === $this) {
                $translation->setArticleContent(null);
            }
        }

        return $this;
    }

    public function translate(string $locale, string $articleContentTranslation)
    {
        $this->addTranslation(new ArticleContentTranslation($locale, $articleContentTranslation));
    }

    public function getType()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    public function getTranslation(string $locale)
    {
        if (!$this->translations->isEmpty()) {
            /** @var ArticleContentTranslation $translation */
            $translation = $this->translations->get($locale);

            return $translation ?? $this;
        }

        return $this;
    }
}
