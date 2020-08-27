<?php


namespace App\Service;


use App\Entity\ArticleContent;

class ArticleContentFormater implements ContentFormaterInterface
{
    public function formatContent(ArticleContent $content)
    {
        return $content->getContent();
    }
}