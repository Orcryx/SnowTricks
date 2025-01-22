<?php

namespace App\Manager;

use App\Entity\Comment;
use App\Entity\Trick;


interface CommentManagerInterface
{
    /**
     * Récupère tous les tricks.
     *
     * @return Comment[]
     */
    public function getCommentsByTrick(Trick $trick): array;
    public function saveComment(Comment $comment): void;
}
