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
     * @ORM\OneToMany(targetEntity=ArticleTranslation::class, mappedBy="article", orphanRemoval=true,
     *     indexBy="locale", cascade={"persist"})
     */
    private $translations;

    public function __construct()
    {
        $this->articleContents = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(ArticleTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setArticle($this);
        }

        return $this;
    }

    public function removeTranslation(ArticleTranslation $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getArticle() === $this) {
                $translation->setArticle(null);
            }
        }

        return $this;
    }

    public function translate(string $locale, string $titleTranslation)
    {
        $this->addTranslation(new ArticleTranslation($locale, $titleTranslation));
    }

    public function getTranslation(string $locale)
    {
        if (!$this->translations->isEmpty()) {
            /** @var ArticleTranslation $translation */
            $translation = $this->translations->get($locale);

            return $translation ?? $this;
        }

        return $this;
    }
}
