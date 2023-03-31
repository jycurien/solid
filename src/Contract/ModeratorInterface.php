<?php

namespace App\Contract;

interface ModeratorInterface
{
    public function isModerationViolation(string $text): bool;
}