<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\ArticleContent;
use App\Entity\MarkdownContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle("Article One With Simple Text Content");
        $content = new ArticleContent();
        $content->setContent(<<<EOD
simple text content
lorem ipsum ...
EOD);
        $article->addArticleContent($content);
        $manager->persist($article);
        $manager->flush();

        $article = new Article();
        $article->setTitle("Article Two With Markdown Content");
        $content = new MarkdownContent();
        $content->setContent(<<<EOD
#Markdown Content
## Subtitle
Lorem ipsum dolor sit **amet** ...
EOD);
        $article->addArticleContent($content);
        $manager->persist($article);
        $manager->flush();

        $article = new Article();
        $article->setTitle("Article Three With Both Content Types");
        $content = new ArticleContent();
        $content->setContent(<<<EOD
simple text content
lorem ipsum ...
EOD);
        $article->addArticleContent($content);

        $content = new MarkdownContent();
        $content->setContent(<<<EOD
#Markdown Content
## Subtitle
Lorem ipsum dolor sit **amet** ...
EOD);
        $article->addArticleContent($content);
        $manager->persist($article);
        $manager->flush();
    }
}
