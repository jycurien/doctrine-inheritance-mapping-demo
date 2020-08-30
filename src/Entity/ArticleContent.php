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
     *     orphanRemoval=true, cascade={"persist"})
     */
    private $articleContentTranslations;

    public function __construct()
    {
        $this->articleContentTranslations = new ArrayCollection();
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
    public function getArticleContentTranslations(): Collection
    {
        return $this->articleContentTranslations;
    }

    public function addArticleContentTranslation(ArticleContentTranslation $articleContentTranslation): self
    {
        if (!$this->articleContentTranslations->contains($articleContentTranslation)) {
            $this->articleContentTranslations[] = $articleContentTranslation;
            $articleContentTranslation->setArticleContent($this);
        }

        return $this;
    }

    public function removeArticleContentTranslation(ArticleContentTranslation $articleContentTranslation): self
    {
        if ($this->articleContentTranslations->contains($articleContentTranslation)) {
            $this->articleContentTranslations->removeElement($articleContentTranslation);
            // set the owning side to null (unless already changed)
            if ($articleContentTranslation->getArticleContent() === $this) {
                $articleContentTranslation->setArticleContent(null);
            }
        }

        return $this;
    }

    public function translate(string $locale, string $articleContentTranslation)
    {
        $this->addArticleContentTranslation(new ArticleContentTranslation($locale, $articleContentTranslation));
    }

    public function getType()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    public function getTranslation(string $locale)
    {
        if (!$this->articleContentTranslations->isEmpty()) {
            /** @var ArticleContentTranslation $articleContentTranslation */
            $articleContentTranslation = $this->articleContentTranslations->filter(function($translation) use ($locale) {
                return $translation->getLocale() === $locale;
            })->first();

            return $articleContentTranslation ? $articleContentTranslation : $this;
        }

        return $this;
    }
}
