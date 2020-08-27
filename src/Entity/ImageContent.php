<?php

namespace App\Entity;

use App\Repository\ImageContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageContentRepository::class)
 */
class ImageContent extends ArticleContent
{
}
