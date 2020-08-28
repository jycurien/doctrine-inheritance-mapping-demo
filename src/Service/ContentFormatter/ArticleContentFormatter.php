<?php


namespace App\Service\ContentFormatter;


use App\Entity\ArticleContent;

class ArticleContentFormatter implements ContentFormatterInterface
{
    public function formatContent(ArticleContent $content, ?string $locale = null)
    {
        return $content->getContent($locale);
    }
}