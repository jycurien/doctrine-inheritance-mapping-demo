<?php


namespace App\Service\ContentFormatter;


use App\Entity\ArticleContent;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubContentFormatter implements ContentFormatterInterface
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function formatContent(ArticleContent $content, ?string $locale = null)
    {
        $response = $this->httpClient->request('GET', $content->getContent(null));
        return '<pre><code class="'.$content->getLanguage().'">'.htmlspecialchars(base64_decode($response->toArray()['content'])).'</code></pre>';
    }
}