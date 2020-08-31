<?php


namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\ContentFormatter\ContentFormatter;
use App\Service\ContentFormatter\MarkdownContentFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/{_locale<fr|en>}/articles", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $repository, MarkdownContentFormatter $formatter)
    {
        $articles = $repository->findAllTranslated();

        return $this->render("article/index.html.twig", [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/{_locale<fr|en>}/articles/{id}", name="article_show", methods={"GET"})
     */
    public function show(int $id, ArticleRepository $repository, Request $request, ContentFormatter $formatter)
    {
        $article = $repository->findOneTranslated($id);
        if (null === $article) {
            throw $this->createNotFoundException(sprintf('There is no article with id %s', $id));
        }
        foreach ($article->getArticleContents() as $content) {
            $content->setContent($formatter->formatContent($content, $request->getLocale()));
        }

        return $this->render("article/show.html.twig", [
            'article' => $article,
        ]);
    }
}