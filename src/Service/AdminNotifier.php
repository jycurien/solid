<?php

namespace App\Service;

use App\Contract\NewArticleNotifierInterface;

class AdminNotifier
{
    /**
     * @param NewArticleNotifierInterface[] $newArticleNotifiers
     */
    public function __construct(
        private readonly array $newArticleNotifiers,
    )
    {
    }

    public function notifyNewArticle(string $title): void
    {
        foreach ($this->newArticleNotifiers as $notifier) {
            $notifier->notifyNewArticle($title);
        }
    }
}