<?php

namespace App\Service\Rating;

use App\Contract\ArticleRaterInterface;
use App\Entity\Article;

class TextRater implements ArticleRaterInterface
{

    public function rate(Article $article): int
    {
        $ratings = ['Poor', 'Average', 'Great'];
        return $this->convertTextRatingToNumeric($ratings[array_rand($ratings)]);
    }

    private function convertTextRatingToNumeric(string $rating): int
    {
        return match ($rating) {
            'Poor' => 1,
            'Great' => 5,
            default => 3,
        };
    }
}