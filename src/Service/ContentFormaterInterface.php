<?php


namespace App\Service;

use App\Entity\ArticleContent;

interface ContentFormaterInterface
{
    public function formatContent(ArticleContent $content);
}