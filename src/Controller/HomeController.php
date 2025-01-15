<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Manager\TrickManagerInterface;

class HomeController extends AbstractController
{
    private TrickManagerInterface $trickManager;

    public function __construct(TrickManagerInterface $trickManager)
    {
        $this->trickManager = $trickManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $tricks = $this->trickManager->getAllTricks();

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
