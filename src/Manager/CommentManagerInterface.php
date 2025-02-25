<?php

namespace App\Manager;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;

interface CommentManagerInterface
{
    /**
     * Récupère les commentaires d'un trick.
     *
     * @return Comment[]
     */
    public function getCommentsByTrick(Trick $trick): array;
    public function createCommentForTrick(Trick $trick): Comment;
    public function handleNewComment(Comment $comment, ?User $user): void;
    public function saveComment(Comment $comment): void;
}
