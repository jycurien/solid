<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\Rating\ArticleRater;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/articles', name: 'article_')]
class ArticleController extends AbstractController
{
    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function index(ArticleRepository $repository): Response
    {
        return $this->render('article/index.html.twig', ['articles' => $repository->findLatest()]);
    }

    #[Route(path: '/{slug}', name: 'show', methods: ['GET'])]
    public function show(ArticleRater $articleRater, Article $article) : Response
    {
        $starsRating = $articleRater->rate($article);
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'starsRating' => $starsRating,
        ]);
    }
}