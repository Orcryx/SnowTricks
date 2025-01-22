<?php

// namespace App\Controller;

// use App\Entity\Comment;
// use App\Entity\Trick;
// use App\Form\CommentType;
// use App\Form\TrickType;
// use App\Manager\TrickManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;


// class TrickController extends AbstractController
// {
//     private TrickManagerInterface $trickManager;

//     public function __construct(TrickManagerInterface $trickManager)
//     {
//         $this->trickManager = $trickManager;
//     }

//     #[Route('/trick', name: 'app_trick_new')]
//     public function new(Request $request): Response
//     {
//         $this->denyAccessUnlessGranted('ROLE_USER');

//         $trick = new Trick();
//         $form = $this->createForm(TrickType::class, $trick);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $trick->setUser($this->getUser());
//             $this->trickManager->createTrick($trick);

//             $this->addFlash('success', 'Création effectuée');
//             return $this->redirectToRoute('app_trick', [
//                 'slug' => $trick->getSlug(),
//                 'id' => $trick->getId(),
//             ]);
//         }

//         return $this->render('trick/form.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }

//     #[Route('/trick/{slug}', name: 'app_trick')]
//     public function trick(Request $request): Response
//     {
//         // dd($request);
//         $trick = $this->trickManager->$comment = new Comment();
//         $form = $this->createForm(CommentType::class, $comment);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $comment->setTrick($trick);
//             $comment->setUser($this->getUser());
//             $this->trickManager->handleCommentForm($comment, $form);

//             $this->addFlash('success', 'Commentaire ajouté');
//             return $this->redirectToRoute('app_trick', [
//                 'slug' => $trick->getSlug(),
//             ]);
//         }

//         return $this->render('trick/index.html.twig', [
//             'trick' => $trick,
//             'form' => $form->createView(),
//         ]);
//     }

//     #[Route('/trick/{id}/edit', name: 'app_trick_edit', methods: ['GET', 'POST'])]
//     public function edit(Request $request, Trick $trick): Response
//     {
//         $form = $this->createForm(TrickType::class, $trick);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $trick->setUser($this->getUser());
//             $this->trickManager->updateTrick($trick);

//             $this->addFlash('success', 'Modification effectuée');
//             return $this->redirectToRoute('app_trick', [
//                 'slug' => $trick->getSlug(),
//                 'id' => $trick->getId(),
//             ]);
//         }

//         return $this->render('trick/form.html.twig', [
//             'trick' => $trick,
//             'form' => $form->createView(),
//         ]);
//     }

//     #[Route('/trick/{id}/delete', name: 'app_trick_remove', methods: ['POST'])]
//     public function remove(Trick $trick): Response
//     {
//         $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//         $this->trickManager->deleteTrick($trick);

//         $this->addFlash('success', 'Suppression effectuée');
//         return $this->redirectToRoute('app_home');
//     }
// }


namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Manager\TrickManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    private TrickManagerInterface $trickManager;

    public function __construct(TrickManagerInterface $trickManager)
    {
        $this->trickManager = $trickManager;
    }

    #[Route('/trick/new', name: 'app_trick_new')]
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUser($this->getUser());

            if ($this->trickManager->createTrick($trick)) {
                // Ajouter un message flash de succès
                $this->addFlash('success', 'Trick créé avec succès !');

                // Rediriger vers la page du trick créé, avec son slug et son id
                return $this->redirectToRoute('app_trick_show', [
                    'slug' => $trick->getSlug(),
                ]);
            }

            // Ajouter un message flash d'erreur
            $this->addFlash('error', 'Le slug existe déjà, veuillez modifier le nom.');
        }

        // Rendre le formulaire dans la vue Twig
        return $this->render('trick/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/trick/{slug}', name: 'app_trick_show')]
    public function show(string $slug): Response
    {
        // Recherche du trick par son slug
        $trick = $this->trickManager->getTrick($slug);

        // Vérification si le trick existe
        if (!$trick) {
            throw $this->createNotFoundException('Trick non trouvé');
        }

        return $this->render('trick/index.html.twig', [
            'trick' => $trick,
        ]);
    }

    #[Route('/trick/{slug}/delete', name: 'app_trick_remove', methods: ['POST'])]
    public function remove(Trick $trick): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Suppression via le TrickManager, qui utilise le TrickRepository
        $this->trickManager->deleteTrick($trick);

        // Message flash et redirection vers la page d'accueil
        $this->addFlash('success', 'Suppression effectuée');
        return $this->redirectToRoute('app_home');
    }
}
