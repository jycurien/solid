<?php

namespace App\Service;

use App\DTO\ArticleDto;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ArticleCreator
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MailerInterface $mailer,
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function create(ArticleDto $articleDto): Article
    {
        $article = new Article();
        $article->setTitle($articleDto->title);
        $article->setSlug($articleDto->slug);
        $article->setContent($articleDto->content);
        $article->setImage($articleDto->image);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        $email = (new Email())
            ->from('my_blog@example.com')
            ->to('admin@example.com')
            ->subject('New article created')
            ->text('A new article has been created: ' . $article->getTitle())
        ;

        $this->mailer->send($email);

        return $article;
    }
}