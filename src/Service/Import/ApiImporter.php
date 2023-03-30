<?php

namespace App\Service\Import;

use App\Contract\HasAuthTokenInterface;
use App\Contract\ImporterInterface;
use App\DTO\ArticleDto;
use App\Service\ArticleCreator;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiImporter implements ImporterInterface, HasAuthTokenInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly ArticleCreator $articleCreator,
        private readonly SluggerInterface $slugger,
        private readonly string $authUrl,
        private readonly string $articlesUrl,
    )
    {
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function importArticles(): void
    {
        $token = $this->getAuthToken();

        $response = $this->client->request('GET', $this->articlesUrl, [
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ]
        ]);

        $articles = json_decode($response->getContent());
        foreach ($articles->posts as $article) {
            $this->articleCreator->create(
                new ArticleDto(
                    $article->title,
                    $this->slugger->slug($article->title),
                    $article->body,
                    "https://picsum.photos/id/" . $article->id + 40 . "/1000/600",
                )
            );
        }
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getAuthToken(): string
    {
        $response = $this->client->request('POST', $this->authUrl,  [
            'body' => [
                'username' => 'kminchelle',
                'password' => '0lelplR',
            ]
        ]);

        return json_decode($response->getContent())->token;
    }
}