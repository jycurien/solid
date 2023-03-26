<?php

namespace App\DTO;

class ArticleDto
{
    public function __construct(
        public ?string $title = null,
        public ?string $slug = null,
        public ?string $content = null,
        public ?string $image = null,
    )
    {
    }
}