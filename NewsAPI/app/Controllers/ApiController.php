<?php


namespace App\Controllers;


use App\Services\ArticleService;
use App\Template;



class ApiController
{


    public function index(): Template
    {
        $search = $_GET["search"] ?? "Covid";

        $articles = (new ArticleService())->execute($search);

        return new Template( "articles/index.twig",
        [
            "articles"=> $articles->get(),
        ],
        );
    }

}







