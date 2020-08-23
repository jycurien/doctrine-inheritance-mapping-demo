<?php

namespace App\Entity;

use App\Repository\MarkdownContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarkdownContentRepository::class)
 */
class MarkdownContent extends ArticleContent
{

}
