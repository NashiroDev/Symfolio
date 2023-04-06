<?php

namespace App\Controller\Backend;

use App\Entity\RowTheme;
use App\Form\RowThemeFormType;
use App\Repository\RowThemeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/theme')]
class RowThemeController extends AbstractController
{
    #[Route('/', name: 'theme.index', methods: ['GET'])]
    public function index(RowThemeRepository $rowThemeRepository): Response
    {
        return $this->render('Backend/theme/index.html.twig', [
            'themes' => $rowThemeRepository->findAll(),
        ]);
    }

    #[Route('/create', name: 'theme.create', methods: ['GET', 'POST'])]
    public function create(Request $request, RowThemeRepository $rowThemeRepository): Response
    {
        $rowTheme = new RowTheme();
        $form = $this->createForm(RowThemeFormType::class, $rowTheme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rowThemeRepository->save($rowTheme, true);

            return $this->redirectToRoute('theme.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Backend/theme/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'theme.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RowTheme $rowTheme, RowThemeRepository $rowThemeRepository): Response
    {
        $form = $this->createForm(RowThemeFormType::class, $rowTheme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rowThemeRepository->save($rowTheme, true);

            return $this->redirectToRoute('theme.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Backend/theme/edit.html.twig', [
            'theme' => $rowTheme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'theme.delete', methods: ['POST'])]
    public function delete(Request $request, RowTheme $rowTheme, RowThemeRepository $rowThemeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $rowTheme->getId(), $request->request->get('_token'))) {

            $rowThemeRepository->remove($rowTheme, true);
        }

        return $this->redirectToRoute('theme.index', [], Response::HTTP_SEE_OTHER);
    }
}