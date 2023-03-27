<?php

namespace App\Service\Rating;

use App\Contract\ArticleRaterInterface;
use App\Entity\Article;

class NumericRater implements ArticleRaterInterface
{

    public function rate(Article $article): int
    {
        return rand(1, 5);
    }
}