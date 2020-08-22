<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $repository)
    {
        $articles = $repository->findAll();

        return $this->render("article/index.html.twig", [
            'articles' => $articles,
        ]);
    }
}