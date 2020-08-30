<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=ArticleContent::class, mappedBy="article", orphanRemoval=true,
     *     cascade={"persist"})
     */
    private $articleContents;

    /**
     * @ORM\OneToMany(targetEntity=ArticleTranslation::class, mappedBy="article", orphanRemoval=true, cascade={"persist"})
     */
    private $articleTranslations;

    public function __construct()
    {
        $this->articleContents = new ArrayCollection();
        $this->articleTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|ArticleContent[]
     */
    public function getArticleContents(): Collection
    {
        return $this->articleContents;
    }

    public function addArticleContent(ArticleContent $articleContent): self
    {
        if (!$this->articleContents->contains($articleContent)) {
            $this->articleContents[] = $articleContent;
            $articleContent->setArticle($this);
        }

        return $this;
    }

    public function removeArticleContent(ArticleContent $articleContent): self
    {
        if ($this->articleContents->contains($articleContent)) {
            $this->articleContents->removeElement($articleContent);
            // set the owning side to null (unless already changed)
            if ($articleContent->getArticle() === $this) {
                $articleContent->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticleTranslation[]
     */
    public function getArticleTranslations(): Collection
    {
        return $this->articleTranslations;
    }

    public function addArticleTranslation(ArticleTranslation $articleTranslation): self
    {
        if (!$this->articleTranslations->contains($articleTranslation)) {
            $this->articleTranslations[] = $articleTranslation;
            $articleTranslation->setArticle($this);
        }

        return $this;
    }

    public function removeArticleTranslation(ArticleTranslation $articleTranslation): self
    {
        if ($this->articleTranslations->contains($articleTranslation)) {
            $this->articleTranslations->removeElement($articleTranslation);
            // set the owning side to null (unless already changed)
            if ($articleTranslation->getArticle() === $this) {
                $articleTranslation->setArticle(null);
            }
        }

        return $this;
    }

    public function translate(string $locale, string $titleTranslation)
    {
        $this->addArticleTranslation(new ArticleTranslation($locale, $titleTranslation));
    }

    public function getTranslation(string $locale)
    {
        if (!$this->articleTranslations->isEmpty()) {
            /** @var ArticleTranslation $articleTranslation */
            $articleTranslation = $this->articleTranslations->filter(function($translation) use ($locale) {
                return $translation->getLocale() === $locale;
            })->first();

            return $articleTranslation ? $articleTranslation : $this;
        }

        return $this;
    }
}
