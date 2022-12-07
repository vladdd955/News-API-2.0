<?php


namespace App\Controllers;


use App\Template;


class AuthorizationController
{

    public function authorizationShow(): Template
    {
        return new Template("authorization.twig");
    }

//    public function store()
//    {
//        $add = (new RegisterService())->checkInLogin();
//        return $add;
//
//    }








}