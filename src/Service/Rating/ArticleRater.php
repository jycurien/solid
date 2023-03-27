<?php

namespace App\Service\Rating;

use App\Contract\ArticleRaterInterface;
use App\Entity\Article;

class ArticleRater
{
    private ArticleRaterInterface $rater;

    public function __construct()
    {
//        $this->rater = new NumericRater(); // BTW this does not respect Dependency Inversion, an interface should be injected
        $this->rater = new TextRater();
    }

    public function rate(Article $article)
    {
        return str_repeat('⭐', $this->rater->rate($article));
    }
}