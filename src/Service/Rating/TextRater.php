<?php

namespace App\Service\Rating;

use App\Contract\ArticleRaterInterface;
use App\Entity\Article;

class TextRater implements ArticleRaterInterface
{

    public function rate(Article $article)
    {
        $ratings = ['Poor', 'Average', 'Great'];
        return $ratings[array_rand($ratings)];
    }
}