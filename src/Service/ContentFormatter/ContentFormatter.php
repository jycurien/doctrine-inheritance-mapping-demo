<?php

namespace App\Service\ContentFormatter;

use App\Entity\ArticleContent;

class ContentFormatter
{
    private $articleContentFormatter;
    private $codeContentFormatter;
    private $githubContentFormatter;
    private $imageContentFormatter;
    private $markdownContentFormatter;

    public function __construct(
        ArticleContentFormatter $articleContentFormatter,
        CodeContentFormatter $codeContentFormatter,
        GithubContentFormatter $githubContentFormatter,
        ImageContentFormatter $imageContentFormatter,
        MarkdownContentFormatter $markdownContentFormatter
    )
    {
        $this->articleContentFormatter = $articleContentFormatter;
        $this->codeContentFormatter = $codeContentFormatter;
        $this->githubContentFormatter = $githubContentFormatter;
        $this->imageContentFormatter = $imageContentFormatter;
        $this->markdownContentFormatter = $markdownContentFormatter;
    }

    public function formatContent(ArticleContent $content, ?string $locale = null)
    {
        $formatter = $this->selectFormatter($content);
        if (null !== $formatter) {
            return $formatter->formatContent($content, $locale);
        }
        return $content->getContent($locale);
    }

    private function selectFormatter(ArticleContent $content)
    {
        $formatterName = lcfirst((new \ReflectionClass($content))->getShortName()).'Formatter';
        if (property_exists($this, $formatterName)) {
            return $this->$formatterName;
        }
        return null;
    }
}