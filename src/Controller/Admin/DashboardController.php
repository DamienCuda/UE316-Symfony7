<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Project');
    }

    public function configureMenuItems(): iterable
    {   
        
        yield MenuItem::section('Dashboard');
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        
        yield MenuItem::section('Articles');
        yield MenuItem::linkToCrud('Gestion des catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Gestion des articles', 'fas fa-newspaper', Post::class);
        yield MenuItem::linkToCrud('Gestion des commentaires', 'fas fa-comment', Comment::class);
        
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Gestion des utilisateurs', 'fas fa-users', User::class);
        
        yield MenuItem::section('Site');
        yield MenuItem::linkToRoute('Accueil', 'fa fa-home', 'app_front');
    }
}
