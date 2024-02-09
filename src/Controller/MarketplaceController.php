<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MarketplaceController extends AbstractController
{
    #[Route('/marketplace', name: 'app_marketplace')]
    public function marketplace(): Response
    {
        return $this->render('marketplace/marketplace.html.twig', [
            'controller_name' => 'MarketplaceController',
        ]);
    }

    #[Route('/marketplace/product/{id}/{slug}', name: 'app_marketplace_product')]
    public function product(): Response
    {
        return $this->render('marketplace/product.html.twig', [
            'controller_name' => 'MarketplaceController',
        ]);
    }
}
