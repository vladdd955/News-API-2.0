<?php


namespace App\Controllers;


use App\Template;


class UserPageController
{

    public function userPageShow(): Template
    {
        return new Template("userPage.twig");
    }
}