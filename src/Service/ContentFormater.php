<?php

namespace App\Service;

use App\Entity\ArticleContent;

class ContentFormater
{
    private $articleContentFormater;
    private $codeContentFormater;
    private $githubContentFormater;
    private $imageContentFormater;
    private $markdownContentFormater;

    public function __construct(
        ArticleContentFormater $articleContentFormater,
        CodeContentFormater $codeContentFormater,
        GithubContentFormater $githubContentFormater,
        ImageContentFormater $imageContentFormater,
        MarkdownContentFormater $markdownContentFormater
    )
    {
        $this->articleContentFormater = $articleContentFormater;
        $this->codeContentFormater = $codeContentFormater;
        $this->githubContentFormater = $githubContentFormater;
        $this->imageContentFormater = $imageContentFormater;
        $this->markdownContentFormater = $markdownContentFormater;
    }

    public function formatContent(ArticleContent $content)
    {
        $formater = $this->selectFormater($content);
        if (null !== $formater) {
            return $formater->formatContent($content);
        }
        return $content->getContent();
    }

    private function selectFormater(ArticleContent $content)
    {
        $formaterName = lcfirst((new \ReflectionClass($content))->getShortName()).'Formater';
        if (property_exists($this, $formaterName)) {
            return $this->$formaterName;
        }
        return null;
    }
}