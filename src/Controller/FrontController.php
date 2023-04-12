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

        $to_send = [];

        foreach ($content as $sub) {
            if (isset($to_send[$sub['theme']]) && sizeof($to_send[$sub['theme']]) < 3) {
                array_push($to_send[$sub['theme']], $sub);
            } elseif (!isset($to_send[$sub['theme']])) {
                $to_send[$sub['theme']] = [$sub];
            }
        }

        return $this->render('Frontend/index.html.twig', [
            'content' => $to_send,
        ]);
    }

    #[Route('/theme/{slug}', name: 'theme')]
    public function theme(string $slug): Response
    {
        $content = $this->contentRepo->getContentByThemeSlug($slug);

        foreach ($content as $sub) {
            $sub[0]->setDescription(substr($sub[0]->getDescription(), 0, 160) . '...');
        }

        return $this->render('Frontend/theme.html.twig', [
            'content' => $content,
        ]);
    }

    #[Route('/section/{slug}', name: 'section')]
    public function section(string $slug): Response
    {
        $content = $this->contentRepo->getContentByContentSlug($slug);       

        return $this->render('Frontend/section.html.twig', [
            'content' => $content,
        ]);
    }
}
