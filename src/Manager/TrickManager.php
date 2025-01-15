<?php

namespace App\Manager;

use App\Entity\Trick;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class TrickManager implements TrickManagerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Récupère tous les tricks.
     *
     * @return Trick[]
     */
    public function getAllTricks(): array
    {
        return $this->entityManager->getRepository(Trick::class)->findAll();
    }

    public function createTrick(Trick $trick): void
    {
        $trick->setCreateAt(new \DateTime());
        $trick->setUpdateAt(new \DateTime());
        $trick->generateSlug();
        $this->entityManager->persist($trick);
        $this->entityManager->flush();
    }

    public function updateTrick(Trick $trick): void
    {
        $trick->setUpdateAt(new \DateTime());
        $trick->generateSlug();
        $this->entityManager->flush();
    }

    public function deleteTrick(Trick $trick): void
    {
        $this->entityManager->remove($trick);
        $this->entityManager->flush();
    }

    public function handleCommentForm(Comment $comment, FormInterface $form): void
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreateAt(new \DateTime());
            $comment->setUpdateAt(new \DateTime());
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
        }
    }
}
