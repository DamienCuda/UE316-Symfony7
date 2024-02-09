<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
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
