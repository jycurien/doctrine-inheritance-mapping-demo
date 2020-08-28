<?php


namespace App\Service\ContentFormatter;


use App\Entity\ArticleContent;

class ImageContentFormatter implements ContentFormatterInterface
{
    public function formatContent(ArticleContent $content, ?string $locale = null)
    {
        return ('<img src="'.$content->getContent(null).'" alt="'.$content->getContent(null).'"');
    }
}