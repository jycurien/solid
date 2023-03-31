<?php

namespace App\Service\Moderation;

use App\Contract\ModeratorInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ChatGPTModerator implements ModeratorInterface
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
    public function isModerationViolation(string $text): bool
    {
        $response = $this->httpClient->request('POST', 'https://api.openai.com/v1/moderations', [
            'auth_bearer' => $this->apiKey,
            'json' => ['input' => $text],
        ]);

        $moderatedResults = json_decode($response->getContent())->results;
        return $moderatedResults[0]->flagged;
    }
}