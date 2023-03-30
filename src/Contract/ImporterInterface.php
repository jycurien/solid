<?php

namespace App\Contract;

interface ImporterInterface
{
    public function importArticles(): void;

    public function getAuthToken(): string;
}