<?php

namespace App\Manager;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Repository\CommentRepository;

class CommentManager implements CommentManagerInterface
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    // Récupérer les commentaires associés à un trick
    public function getCommentsByTrick(Trick $trick): array
    {
        return $this->commentRepository->findBy(['trick' => $trick], ['createAt' => 'DESC']);
    }

    // Sauvegarder un commentaire
    public function saveComment(Comment $comment): void
    {
        $currentDate = new \DateTime();

        // $comment->setCreateAt(new \DateTime());
        // $comment->setUpdateAt(new \DateTime());
        $this->commentRepository->manageDate($comment, $currentDate);
        $this->commentRepository->save($comment);
    }
}
