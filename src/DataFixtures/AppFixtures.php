<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\ArticleContent;
use App\Entity\CodeContent;
use App\Entity\GithubContent;
use App\Entity\ImageContent;
use App\Entity\MarkdownContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle("Premier Article");
        $article->translate('en', 'First Article');
        $content = new ImageContent();
        $content->setContent('https://picsum.photos/400/200');
        $article->addArticleContent($content);

        $content = new ArticleContent();
        $content->setContent(<<<EOF
Bonjour, il fait beau aujourd'hui...
lorem ipsum ...
EOF
        );
        $content->translate('en', 'translated text content');
        $content->translate('de', 'translated german content');
        $article->addArticleContent($content);

        $content = new GithubContent();
        $content->setContent('https://api.github.com/repos/jycurien/doctrine-behaviors-demo/contents/src/Entity/Article.php?ref=b206f4bfb9678df21df5516edaf643b117dee02a');
        $content->setLanguage('php');
        $article->addArticleContent($content);
        $manager->persist($article);
        $manager->flush();

        $article = new Article();
        $article->setTitle("Article Two With Markdown Content");
        $content = new MarkdownContent();
        $content->setContent(<<<EOF
##Markdown Content

Images could be input in markdown so we might no need the image type ?

![alt text](https://picsum.photos/400/200)

Also code could be input in markdown ...
```javascript
import 'knacss/css/knacss.css';
import '../css/app.css';
import marked from 'marked';

window.addEventListener('DOMContentLoaded', () => {

    const inputTextTextarea = document.querySelector('#js-input-text');
    const parsedTextDiv = document.querySelector('#js-parsed-text');

    inputTextTextarea.addEventListener('keyup', () => {
        const text = inputTextTextarea.value;
        parsedTextDiv.innerHTML = marked(text);
    });

});
```
Lorem ipsum dolor sit **amet** ...
EOF
        );
        $content->translate('en', 'translated **markdown** content');
        $article->addArticleContent($content);
        $manager->persist($article);
        $manager->flush();

        $article = new Article();
        $article->setTitle("Article Three With Both Content Types");
        $content = new ArticleContent();
        $content->setContent(<<<EOF
simple text content
lorem ipsum ...
EOF
        );
        $article->addArticleContent($content);

        $content = new MarkdownContent();
        $content->setContent(<<<EOF
##Markdown Content

Lorem ipsum dolor sit **amet** ...
EOF
        );
        $article->addArticleContent($content);
        $manager->persist($article);
        $manager->flush();

        $article = new Article();
        $article->setTitle("Article Four With Code and Markdown Content Types");

        $content = new MarkdownContent();
        $content->setContent(<<<EOF
##Markdown Content

Lorem ipsum dolor sit **amet** ...
EOF
        );
        $article->addArticleContent($content);

        $content = new CodeContent();
        $content->setContent(<<<EOF
import 'knacss/css/knacss.css';
import '../css/app.css';
import marked from 'marked';

window.addEventListener('DOMContentLoaded', () => {

    const inputTextTextarea = document.querySelector('#js-input-text');
    const parsedTextDiv = document.querySelector('#js-parsed-text');

    inputTextTextarea.addEventListener('keyup', () => {
        const text = inputTextTextarea.value;
        parsedTextDiv.innerHTML = marked(text);
    });

});
EOF
        );
        $content->setLanguage('javascript');
        $article->addArticleContent($content);
        $manager->persist($article);

        $manager->flush();
    }
}
