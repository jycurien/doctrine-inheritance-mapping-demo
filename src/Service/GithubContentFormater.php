<?php


namespace App\Service;


use App\Entity\ArticleContent;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubContentFormater implements ContentFormaterInterface
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function formatContent(ArticleContent $content)
    {
        $response = $this->httpClient->request('GET', $content->getContent());
        return '<pre><code class="'.$content->getLanguage().'">'.htmlspecialchars(base64_decode($response->toArray()['content'])).'</code></pre>';
    }
}