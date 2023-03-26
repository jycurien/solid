<?php

namespace App\Contract;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('new_article_notifier')]
interface NewArticleNotifierInterface
{
    public function notifyNewArticle(string $title): void;
}