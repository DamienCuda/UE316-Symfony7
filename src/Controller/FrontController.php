<?php

namespace App\Controller;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(PostRepository $postRepository): Response
    {
        $latestPosts = $postRepository->findBy([], ['updatedAt' => 'DESC'], 3);

        return $this->render('front/index.html.twig', [
            'latestPosts' => $latestPosts,
        ]);
    }
    #[Route('/notre-methode-pedagogique', name: 'app_methode')]
    public function method(): Response
    {
        return $this->render('front/method.html.twig', [
        ]);
    }
    #[Route('/partenaire', name: 'app_partner')]
    public function partner(): Response
    {
        return $this->render('front/partner.html.twig', [
        ]);
    }
}
