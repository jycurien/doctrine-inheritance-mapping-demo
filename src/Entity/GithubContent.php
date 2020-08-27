<?php

namespace App\Entity;

use App\Repository\GithubContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GithubContentRepository::class)
 */
class GithubContent extends ArticleContent
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $language;

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }
}
