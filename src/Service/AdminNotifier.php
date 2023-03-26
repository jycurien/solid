<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AdminNotifier
{
    public function __construct(
        private readonly MailerInterface $mailer,
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
    }
}