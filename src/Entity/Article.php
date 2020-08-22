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
     * @ORM\OneToMany(targetEntity=ArticleContent::class, mappedBy="article", orphanRemoval=true)
     */
    private $articleContents;

    public function __construct()
    {
        $this->articleContents = new ArrayCollection();
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
}
