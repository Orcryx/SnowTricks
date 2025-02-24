<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Manager\CommentManagerInterface;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Manager\TrickManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    private TrickManagerInterface $trickManager;
    private CommentManagerInterface $commentManager;

    public function __construct(TrickManagerInterface $trickManager, CommentManagerInterface $commentManager)
    {
        $this->trickManager = $trickManager;
        $this->commentManager = $commentManager;
    }

    //Créer un trick
    #[Route('/trick/new', name: 'app_trick_new')]
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_USER');

        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUser($this->getUser());

            if ($this->trickManager->createTrick($trick)) {
                $this->addFlash('success', 'Trick créé avec succès !');

                return $this->redirectToRoute('app_trick_show', [
                    'slug' => $trick->getSlug(),
                ]);
            } else {
                $this->addFlash('error', 'Le slug existe déjà, veuillez modifier le nom.');
            }
        }

        return $this->render('trick/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/trick/{slug}', name: 'app_trick_show')]
    public function show(Request $request, string $slug): Response
    {
        $trick = $this->trickManager->getTrick($slug);

        if (!$trick) {
            throw $this->createNotFoundException('Trick non trouvé');
        }

        // Récupérer les commentaires associés au trick
        $comments = $this->commentManager->getCommentsByTrick($trick);

        // Créer un nouveau commentaire
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setTrick($trick);
            $comment->setUser($this->getUser());
            $this->commentManager->saveComment($comment); // Utilisation du CommentManager pour sauvegarder le commentaire
            $this->addFlash('success', 'Commentaire ajouté');

            return $this->redirectToRoute('app_trick_show', [
                'slug' => $trick->getSlug(),
            ]);
        }

        return $this->render('trick/index.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }

    //supprimer un trick
    #[Route('/trick/{slug}/delete', name: 'app_trick_remove')]
    public function remove(string $slug): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $trick = $this->trickManager->getTrick($slug);

        $isdelete = $this->trickManager->deleteTrick($trick);

        if (!$isdelete) {
            $this->addFlash('success', 'Suppression effectuée');
        } else {
            $this->addFlash('error', 'Échec de la suppression');
        }

        return $this->redirectToRoute('app_home');
    }

    // //Editer un trick
    // #[Route('/trick/{slug}/edit', name: 'app_trick_edit')]
    // public function edit(Request $request, string $slug): Response
    // {
    //     // Recherche du trick par son slug
    //     $trick = $this->trickManager->getTrick($slug);
    //     $form = $this->createForm(TrickType::class, $trick);
    //     $form->handleRequest($request);

    //     foreach ($form->getErrors(true) as $error) {
    //         $errors[] = ['error' => $error->getMessage()];
    //     }
    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $trick->setUser($this->getUser());
    //         $this->trickManager->updateTrick($trick);

    //         $this->addFlash('success', 'Modification effectuée');
    //         return $this->redirectToRoute('app_trick_show', [
    //             'slug' => $trick->getSlug(),
    //         ]);
    //     }

    //     if ($form->isSubmitted() && !$form->isValid()) {
    //         $this->addFlash('error', 'Il y a une erreur de saisie dans le formulaire.');
    //     }


    //     return $this->render('trick/edit.html.twig', [
    //         'trick' => $trick,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/trick/{slug}/edit', name: 'app_trick_edit')]
    public function edit(Request $request, string $slug, EntityManagerInterface $entityManager): Response
    {
        // Recherche du trick par son slug
        $trick = $this->trickManager->getTrick($slug);
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    $trick->setUser($this->getUser());
                    $this->trickManager->updateTrick($trick);

                    $this->addFlash('success', 'Le trick a été modifié avec succès.');
                    return $this->redirectToRoute('app_trick_show', [
                        'slug' => $trick->getSlug(),
                    ]);
                } catch (UniqueConstraintViolationException $e) {
                    $this->addFlash('error', 'Ce nom de trick est déjà utilisé. Veuillez en choisir un autre.');
                }
            } else {
                $this->addFlash('error', 'Il y a une erreur dans le formulaire.');
            }
        }

        return $this->render('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }
}
