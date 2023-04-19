<?php

namespace App\Controller\Backend;

use App\Entity\Content;
use App\Form\ContentFormType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/content')]
class ContentController extends AbstractController
{
    #[Route('/', name: 'content.index', methods: ['GET'])]
    public function index(ContentRepository $contentRepository): Response
    {
        return $this->render('Backend/content/index.html.twig', [
            'content' => $contentRepository->findAll(),
        ]);
    }

    #[Route('/create', name: 'content.create', methods: ['GET', 'POST'])]
    public function create(Request $request, ContentRepository $contentRepository): Response
    {
        $content = new Content();
        $form = $this->createForm(ContentFormType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contentRepository->save($content, true);

            return $this->redirectToRoute('content.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Backend/content/create.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route('/edit/{id}', name: 'content.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContentRepository $contentRepository, Content $content): Response
    {
        $form = $this->createForm(ContentFormType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contentRepository->save($content, true);

            return $this->redirectToRoute('content.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Backend/content/edit.html.twig', [
            'form' => $form,
            'content' => $content,
        ]);
    }

    #[Route('/{id}', name: 'content.delete', methods: ['POST'])]
    public function delete(Request $request, Content $content, ContentRepository $contentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $content->getId(), $request->request->get('_token'))) {

            $contentRepository->remove($content, true);
        }

        return $this->redirectToRoute('content.index', [], Response::HTTP_SEE_OTHER);
    }
}