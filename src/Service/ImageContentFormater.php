<?php


namespace App\Service;


use App\Entity\ArticleContent;

class ImageContentFormater implements ContentFormaterInterface
{
    public function formatContent(ArticleContent $content)
    {
        return ('<img src="'.$content->getContent().'" alt="'.$content->getContent().'"');
    }
}