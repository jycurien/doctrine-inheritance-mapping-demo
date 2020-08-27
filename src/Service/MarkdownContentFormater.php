<?php


namespace App\Service;


use App\Entity\ArticleContent;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownContentFormater implements ContentFormaterInterface
{
    private $parser;

    public function __construct(MarkdownParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function formatContent(ArticleContent $content)
    {
        return $this->parser->transformMarkdown($content->getContent());
    }
}