<?php

namespace App\Contract;

interface HasAuthTokenInterface
{
    public function getAuthToken(): string;
}