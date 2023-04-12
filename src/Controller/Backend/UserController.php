<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'user.index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('Backend/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/edit/{id}', name: 'user.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('user.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Backend/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'user.delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {

            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('user.index', [], Response::HTTP_SEE_OTHER);
    }
}