<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TrickRepository;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findAll();
        // dd($tricks);
        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
