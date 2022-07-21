<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Publications;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Walanda 5 4 0 0');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToRoute('Mon Site', 'fa fa-home', 'app_home');
        yield MenuItem::linkToRoute('Mon Blog', 'fa fa-blog', 'app_blog');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', Users::class);
        yield MenuItem::subMenu('Publications', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Toutes les publications', 'fas fa-list', Publications::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Publications::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Toutes les catégories', 'fas fa-list', Categories::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Categories::class)->setAction(Crud::PAGE_NEW),
        ]);
    }
}