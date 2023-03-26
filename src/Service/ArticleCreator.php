<?php

namespace App\Service;

use App\DTO\ArticleDto;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleCreator
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function create(ArticleDto $articleDto): Article
    {
        $article = new Article();
        $article->setTitle($articleDto->title);
        $article->setSlug($articleDto->slug);
        $article->setContent($articleDto->content);
        $article->setImage($articleDto->image);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $article;
    }
}