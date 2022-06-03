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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ){
    }

    #[Route('/admin', name: 'admin')]
    //#[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');

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
        yield MenuItem::subMenu('COLLECTIVITES', 'fas fa-building')->setSubItems([
            MenuItem::linkToCrud('Créer une collectivité', 'fas fa-plus', Collectivite::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des collectivités', 'fas fa-border-all', Collectivite::class)
        ]);

        yield MenuItem::subMenu('EXTRANETS', 'fas fa-buromobelexperte')->setSubItems([
            MenuItem::linkToCrud('Ajouter un extranet', 'fas fa-plus', Extranet::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des extranets', 'fas fa-border-all', Extranet::class)
        ]);

        yield MenuItem::subMenu('COMPTES', 'fas fa-male')->setSubItems([
            MenuItem::linkToCrud('Créer un compte', 'fas fa-plus', Compte::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des comptes', 'fas fa-border-all', Compte::class)
        ]);

        yield MenuItem::subMenu('ETAT')->setSubItems([
            MenuItem::linkToCrud('Créer un état', 'fas fa-plus', Etat::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Etats disponibles', 'fas fa-eye', Etat::class)
        ]);

    }
}
