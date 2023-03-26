<?php

namespace App\Service;

use App\DTO\ArticleDto;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleUpdater
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function update(ArticleDto $articleDto, Article $article): Article
    {
        $article->setTitle($articleDto->title);
        $article->setSlug($articleDto->slug);
        $article->setContent($articleDto->content);
        $article->setImage($articleDto->image);

        $this->entityManager->flush();

        return $article;
    }
}