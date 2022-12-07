<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Collections\ArticlesCollection;
use Carbon\Carbon;
use jcobhams\NewsApi\NewsApi;

class ArticleService
{

    public function execute($search): ArticlesCollection
    {
        $newsapi = new NewsApi("db87e8bec0044bbe9fb9c5d9e667406e");

        $articlesApi = $newsapi->getEverything($search);

        $articles = new ArticlesCollection();
        foreach ($articlesApi->articles as $article) {
            $articles->add(new Article(
                $article->title,
                $article->url,
                $article->description,
//                Carbon::createFromDate($article->published)->format("d.m.Y h:i"),
                $article->urlToImage
            ));
        }
        return $articles;
    }
}
