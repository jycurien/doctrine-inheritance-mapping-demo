<?php


namespace App\Service\ContentFormatter;


use App\Entity\ArticleContent;

class CodeContentFormatter implements ContentFormatterInterface
{

    public function formatContent(ArticleContent $content, ?string $locale = null)
    {
        return ('<pre><code class="'.$content->getLanguage().'">'.htmlspecialchars($content->getContent(null)).'</code></pre>');
    }
}