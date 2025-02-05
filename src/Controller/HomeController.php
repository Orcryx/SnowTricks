<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Manager\TrickManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{

    public function __construct(private readonly TrickManagerInterface $trickManager) {}

    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $page = max(1, $request->query->getInt('page', 1));
        $tricks = $this->trickManager->getPaginatedTricks($page);
        $totalTricks = $this->trickManager->getNumberTricks();
        $totalPages = ceil($totalTricks / 5);

        // Vérifie si la requête est AJAX
        if ($request->isXmlHttpRequest()) {
            $html = $this->renderView('home/_tricks.html.twig', [
                'tricks' => $tricks,
                'currentPage' => $page,
                'totalPages' => $totalPages,
            ]);

            // Crée un rendu de la pagination dynamique
            $pagination = $this->renderView('home/_pagination.html.twig', [
                'currentPage' => $page,
                'totalPages' => $totalPages,
            ]);

            //TODO : investiguer l'utilisation du JSON
            return new JsonResponse(['html' => $html, 'pagination' => $pagination]);
        }

        // Retourne la page complète pour une requête normale
        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}
