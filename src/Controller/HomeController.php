<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home_index', methods: ['GET'])]
    public function index(ArticleRepository $repository): Response
    {
        return $this->render('home/index.html.twig', ['articles' => $repository->findLatest(4)]);
    }
}