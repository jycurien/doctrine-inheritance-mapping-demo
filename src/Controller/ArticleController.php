<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use App\Service\ContentFormater;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $repository, ContentFormater $formater)
    {
        $articles = $repository->findAll();
        foreach ($articles as $article) {
            foreach ($article->getArticleContents() as $content) {
                $content->setContent($formater->formatContent($content));
            }
        }

        return $this->render("article/index.html.twig", [
            'articles' => $articles,
        ]);
    }
}