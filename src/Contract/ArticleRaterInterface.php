<?php

namespace App\Contract;

use App\Entity\Article;

interface ArticleRaterInterface
{
    public function rate(Article $article);
}