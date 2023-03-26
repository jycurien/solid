<?php

namespace App\Contract;

interface NewArticleNotifierInterface
{
    public function notifyNewArticle(string $title): void;
}