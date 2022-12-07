<?php

namespace App\Models;


class Article
{
    private string $title;
    private string $url;
    private string $description;
//    private string $published;
    private ?string $picture;

//     string $published,

    public function __construct(string $title, string $url, string $description, ?string $picture)
    {

        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
//        $this->published = $published;
        $this->picture = $picture;

    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

//    public function getPublished(): string
//    {
//        return $this->published;
//    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }
}
