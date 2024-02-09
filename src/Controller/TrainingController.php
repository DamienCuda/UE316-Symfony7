<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TrainingController extends AbstractController
{
    #[Route('/formations', name: 'app_formations')]
    public function index(): Response
    {
        return $this->render('training/formations.html.twig', [
            'controller_name' => 'TrainingController',
        ]);
    }

    #[Route('/formations/{id}-{slug}', name: 'app_formation_detail')]
    public function detailsFormation(): Response
    {
        return $this->render('training/formation-detail.html.twig', [
            'controller_name' => 'TrainingController',
        ]);
    }
}
