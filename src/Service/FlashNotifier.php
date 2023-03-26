<?php

namespace App\Service;

use App\Contract\NewArticleNotifierInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class FlashNotifier implements NewArticleNotifierInterface
{
    public function __construct(
        private readonly RequestStack $requestStack,
    )
    {
    }

    public function notifyNewArticle(string $title): void
    {
        $this->requestStack->getSession()->getFlashBag()->add('success', 'A new article has been created: ' . $title);
    }
}