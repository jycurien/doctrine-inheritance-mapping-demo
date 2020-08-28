<?php


namespace App\Service\ContentFormatter;


use App\Entity\ArticleContent;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownContentFormatter implements ContentFormatterInterface
{
    private $parser;

    public function __construct(MarkdownParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function formatContent(ArticleContent $content, ?string $locale = null)
    {
        return $this->parser->transformMarkdown($content->getContent($locale));
    }
}