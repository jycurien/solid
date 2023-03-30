<?php

namespace App\Service\Import;

use App\Contract\ImporterInterface;
use App\DTO\ArticleDto;
use App\Service\ArticleCreator;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class LocalFileImporter implements ImporterInterface
{
    public function __construct(
        private readonly FileSystem $fileSystem,
        private readonly ArticleCreator $articleCreator,
        private readonly string $filePath,
    )
    {
    }

    public function importArticles(): void
    {
        if (!$this->fileSystem->exists($this->filePath)) {
            throw new FileNotFoundException(sprintf('File %s not found', $this->filePath));
        }
        $articles = Yaml::parseFile($this->filePath);
        foreach ($articles as $article) {
            $this->articleCreator->create(
                new ArticleDto(
                    $article['title'],
                    $article['slug'],
                    $article['content'],
                    $article['image'],
                )
            );
        }
    }

    public function getAuthToken(): string
    {
        return 'whatever...';
    }
}