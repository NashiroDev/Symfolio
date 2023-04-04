<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContentRepository;

class FrontController extends AbstractController
{
    public function __construct(
        private readonly ContentRepository $contentRepo
    )
    {}

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $content = $this->contentRepo->getAllOrderByAsc();

        return $this->render('Frontend/index.html.twig', [
            'content' => $content,
        ]);
    }

    #[Route('/theme/{slug}', name: 'theme')]
    public function theme(string $slug): Response
    {
        $content = $this->contentRepo->getContentByThemeSlug($slug);

        return $this->render('Frontend/theme.html.twig', [
            'content' => $content,
        ]);
    }
}
