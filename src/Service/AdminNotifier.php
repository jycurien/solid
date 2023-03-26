<?php

namespace App\Service;

use App\Contract\NewArticleNotifierInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class AdminNotifier
{
    /**
     * @param NewArticleNotifierInterface[] $newArticleNotifiers
     */
    public function __construct(
        #[TaggedIterator(tag: 'new_article_notifier')]
        private readonly iterable $newArticleNotifiers,
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