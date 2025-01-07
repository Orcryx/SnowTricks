<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TrickRepository;


class TrickController extends AbstractController
{
    // #[Route('/trick', name: 'app_tricks')]
    // public function index(Request $request, TrickRepository $trickRepository): Response
    // {
    //     $tricks = $trickRepository->findAll();
    //     dd($trick);
    //     return $this->render('trick/index.html.twig', [
    //         'tricks' => $tricks,
    //     ]);
    // }

    #[Route('/trick/{slug}{id}', name: 'app_trick')]
    public function trick(Request $request, TrickRepository $trickRepository, string $slug, int $id): Response
    {
        // dd($id);
        // $trick = $trickRepository->findOneBy(['slug' => $slug]);
        $trick = $trickRepository->find($id);
        // dd($trick);
        return $this->render('trick/index.html.twig', [
            'trick' => $trick,
        ]);
    }
}
