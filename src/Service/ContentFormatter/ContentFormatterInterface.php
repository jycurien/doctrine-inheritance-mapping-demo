<?php


namespace App\Service\ContentFormatter;

use App\Entity\ArticleContent;

interface ContentFormatterInterface
{
    public function formatContent(ArticleContent $content, ?string $locale = null);
}