<?php

namespace App\Service\Rating;

use App\Contract\ArticleRaterInterface;
use App\Entity\Article;

class ArticleRater
{
    public function __construct(
        private readonly ArticleRaterInterface $rater
    )
    {
    }

    public function rate(Article $article)
    {
        return str_repeat('⭐', $this->rater->rate($article));
    }
}