<?php


namespace App\Service;


use App\Entity\ArticleContent;

class CodeContentFormater implements ContentFormaterInterface
{

    public function formatContent(ArticleContent $content)
    {
        return ('<pre><code class="'.$content->getLanguage().'">'.htmlspecialchars($content->getContent()).'</code></pre>');
    }
}