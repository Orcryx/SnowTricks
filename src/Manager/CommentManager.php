<?php

namespace App\Manager;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use App\Repository\CommentRepository;


class CommentManager implements CommentManagerInterface
{
    public function __construct(private readonly CommentRepository $commentRepository) {}

    // Récupérer les commentaires associés à un trick
    public function getCommentsByTrick(Trick $trick): array
    {
        return $this->commentRepository->findBy(['trick' => $trick], ['createAt' => 'DESC']);
    }

    // Créer un commentaire pour un trick avec initialisation des dates
    public function createCommentForTrick(Trick $trick): Comment
    {
        $comment = new Comment();
        $comment->setTrick($trick);
        $comment->setCreateAt(new \DateTime());
        $comment->setUpdateAt(new \DateTime());

        return $comment;
    }

    // Gérer l'ajout d'un commentaire (ajout de l'utilisateur et sauvegarde)
    public function handleNewComment(Comment $comment, ?User $user): void
    {
        $comment->setUser($user);
        $this->saveComment($comment);
    }

    // Sauvegarder un commentaire avec mise à jour des dates
    public function saveComment(Comment $comment): void
    {
        $currentDate = new \DateTime();
        $comment->setUpdateAt($currentDate);

        if ($comment->getCreateAt() === null) {
            $comment->setCreateAt($currentDate);
        }

        $this->commentRepository->save($comment);
    }
}
