<?php

namespace App\DTO;

use App\Service\Validation\IsSafeText;

class ArticleDto
{
    public function __construct(
        #[IsSafeText]
        public ?string $title = null,
        public ?string $slug = null,
        #[IsSafeText]
        public ?string $content = null,
        public ?string $image = null,
    )
    {
    }
}