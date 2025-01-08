<?php

namespace App\Controller;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TrickRepository;
use App\Repository\CommentRepository;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Form\CommentType;

class TrickController extends AbstractController
{

    #[Route('/trick', name: 'app_trick_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        //La page est accessible aux utilisateurs
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour créer un trick.');
        }

        // Crée une nouvelle instance de Trick si elle n'est pas fournie
        $trick = new Trick();

        // Créer le formulaire
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        $user = $this->getUser();

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setCreateAt(new \DateTime());
            $trick->setUpdateAt(new \DateTime());
            $trick->setUser($user);
            $trick->generateSlug();
            // Sauvegarde l'entité dans la base de données
            $entityManager->persist($trick);
            $entityManager->flush();

            // Message flash de succès
            $this->addFlash('success', 'Création effectuée');

            // Redirige vers la page du trick créé
            return $this->redirectToRoute('app_trick', [
                'slug' => $trick->getSlug(),
                'id' => $trick->getId(),
            ]);
        }

        // Affiche le formulaire de création
        return $this->render('trick/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/trick/{slug}{id}', name: 'app_trick')]
    public function trick(Request $request, EntityManagerInterface $entityManager, TrickRepository $trickRepository, int $id): Response
    {
        // $trick = $trickRepository->findOneBy(['slug' => $slug]);

        // Récupérer le Trick à partir de l'ID
        $trick = $trickRepository->find($id);
        if (!$trick) {
            throw $this->createNotFoundException('Le trick demandé n\'existe pas.');
        }

        $comment = new Comment();
        $user = $this->getUser();

        // Vérifier que cette méthode existe dans l'entité Comment
        $comment->setTrick($trick);

        // Créer le formulaire pour le commentaire
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreateAt(new \DateTime());
            $comment->setUpdateAt(new \DateTime());
            $comment->setUser($user);
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('success', 'Modification effectuée');

            // Redirige vers la page du trick 
            return $this->redirectToRoute('app_trick', [
                'slug' => $trick->getSlug(),
                'id' => $trick->getId(),
            ]);
        }
        return $this->render('trick/index.html.twig', [
            'trick' => $trick,
            'form' => $form
        ]);
    }

    #[Route('/trick/{id}/edit', name: 'app_trick_edit',  methods: ['GET', 'POST'])]
    public function edit(Trick $trick, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUpdateAt(new \DateTime());
            $trick->setUser($user);
            $trick->generateSlug();
            // Sauvegarde l'entité dans la base de données
            $entityManager->flush();
            $this->addFlash('success', 'Modification effectuée');

            // Redirige vers la page du trick 
            return $this->redirectToRoute('app_trick', [
                'slug' => $trick->getSlug(),
                'id' => $trick->getId(),
            ]);
        }
        return $this->render('trick/form.html.twig', ['trick' => $trick, 'form' => $form]);
    }

    #[Route('/trick/{id}/delete', name: 'app_trick_remove', methods: ['DELETE'])]
    public function remove(Trick $trick, EntityManagerInterface $entityManager): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager->remove($trick);
        $entityManager->flush();
        $this->addFlash('success', 'Suppression effectuée');
        return $this->redirectToRoute('app_home');
    }
}
