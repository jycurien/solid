<?php

namespace App\Service\Moderation;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ChatGPTModerator
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $apiKey
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function moderate(string $text): array
    {
        $response = $this->httpClient->request('POST', 'https://api.openai.com/v1/moderations', [
            'auth_bearer' => $this->apiKey,
            'json' => ['input' => $text],
        ]);

        return json_decode($response->getContent())->results;
    }
}