<?php

namespace App\Controller\Admin;

use App\DTO\ArticleDto;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Service\AdminNotifier;
use App\Service\ArticleCreator;
use App\Service\ArticleUpdater;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/articles', name: 'admin_article_')]
class ArticleController extends AbstractController
{
    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function index(ArticleRepository $repository): Response
    {
        return $this->render('admin/article/index.html.twig', ['articles' => $repository->findLatest()]);
    }

    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(ArticleCreator $articleCreator, AdminNotifier $adminNotifier, Request $request, EntityManagerInterface $entityManager): Response
    {
        $articleDto = new ArticleDto();

        $form = $this->createForm(ArticleType::class, $articleDto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $articleCreator->create($articleDto);
            $adminNotifier->notifyNewArticle($article->getTitle());
            return $this->redirectToRoute('article_show', ['slug' => $article->getSlug()]);
        }

        return $this->render('admin/article/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route(path: '/{slug}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(ArticleUpdater $articleUpdater, Request $request, EntityManagerInterface $entityManager, Article $article): Response
    {
        $articleDto = new ArticleDto(
            $article->getTitle(),
            $article->getSlug(),
            $article->getContent(),
            $article->getImage()
        );
        $form = $this->createForm(ArticleType::class, $articleDto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $articleUpdater->update($articleDto, $article);
            return $this->redirectToRoute('article_show', ['slug' => $article->getSlug()]);
        }

        return $this->render('admin/article/edit.html.twig', [
            'form' => $form,
            'article' => $article,
        ]);
    }

    #[Route(path: '/{slug}', name: 'delete', methods: ['DELETE'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, Article $article): Response
    {
        $submittedToken = $request->request->get('token');

        if ($this->isCsrfTokenValid('delete-article', $submittedToken)) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_article_index');
    }
}