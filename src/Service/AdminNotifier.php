<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AdminNotifier
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly RequestStack $requestStack,
    )
    {
    }

    public function notifyNewArticle(string $title): void
    {
        $email = (new Email())
            ->from('my_blog@example.com')
            ->to('admin@example.com')
            ->subject('New article created')
            ->text('A new article has been created: ' . $title)
        ;

        $this->mailer->send($email);

        $this->requestStack->getSession()->getFlashBag()->add('success', 'A new article has been created: ' . $title);
    }
}