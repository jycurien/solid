<?php

namespace App\Service\Import;

use App\Contract\ImporterInterface;
use App\DTO\ArticleDto;
use App\Service\ArticleCreator;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiImporter implements ImporterInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly ArticleCreator $articleCreator,
        private readonly SluggerInterface $slugger,
        private readonly string $url,
    )
    {
    }

    public function importArticles(): void
    {
        $response = $this->client->request('GET', $this->url);
        $articles = json_decode($response->getContent());
        foreach ($articles as $article) {
            $this->articleCreator->create(
                new ArticleDto(
                    $article->title,
                    $this->slugger->slug($article->title),
                    $article->body,
                    "https://picsum.photos/id/" . $article->id + 20 . "/1000/600",
                )
            );
        }
    }
}