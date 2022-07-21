<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Publications;
use App\Repository\CommentsRepository;
use App\Repository\CategoriesRepository;
use App\Repository\PublicationsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublicationsController extends AbstractController
{
    #[Route('/publications', name: 'app_publications')]
    public function index(
        Environment $twig,
        PublicationsRepository $publicationsRepos,
        CategoriesRepository $categoriesRepos,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $publication = $paginator->paginate(
            $query = $publicationsRepos->findAll(),
            $request->query->getInt('page', 1),
            2
        );
        return new Response($twig->render('publications/index.html.twig', [
            'publications' => $publication,
            'categories' => $categoriesRepos->findAll(),
        ]));
    }

    #[Route('/publications/{slug}', name: 'app_publications_show')]
    public function show(Environment $twig, Publications $publications, CommentsRepository $commentsRepos): Response
    {

        return new Response($twig->render('publications/show.html.twig', [
            'publication' => $publications,
            'comments' => $commentsRepos->findBy(['publication' => $publications], ['createdAt' => 'DESC'])
        ]));
    }
}