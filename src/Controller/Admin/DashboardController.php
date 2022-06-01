<?php

namespace App\Controller\Admin;

use App\Entity\Collectivite;
use App\Entity\Compte;
use App\Entity\Etat;
use App\Entity\Extranet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ){
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(CollectiviteCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TABLEAU DE BORD');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('ADMINISTRATION');
        yield MenuItem::subMenu('COLLECTIVITES', 'fas fa-home')->setSubItems([
            MenuItem::linkToCrud('Créer une collectivité', 'fas fa-home', Collectivite::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des collectivités', 'fas fa-eye', Collectivite::class)
        ]);

        yield MenuItem::subMenu('EXTRANETS', 'fas fa-home')->setSubItems([
            MenuItem::linkToCrud('Créer un extranet', 'fas fa-home', Extranet::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des extranets', 'fas fa-eye', Extranet::class)
        ]);

        yield MenuItem::subMenu('COMPTES', 'fas fa-home')->setSubItems([
            MenuItem::linkToCrud('Créer un compte', 'fas fa-home', Compte::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des comptes', 'fas fa-eye', Compte::class)
        ]);

        yield MenuItem::subMenu('ETAT', 'fas fa-home')->setSubItems([
            MenuItem::linkToCrud('Créer un état', 'fas fa-home', Etat::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Etats disponibles', 'fas fa-eye', Etat::class)
        ]);

    }
}
