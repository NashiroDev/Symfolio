<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('', name: 'admin.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Backend/index.html.twig');
    }
}