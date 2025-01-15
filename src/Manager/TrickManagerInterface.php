<?php

namespace App\Manager;

use App\Entity\Trick;
use App\Entity\Comment;
use Symfony\Component\Form\FormInterface;

interface TrickManagerInterface
{
    /**
     * Récupère tous les tricks.
     *
     * @return Trick[]
     */
    public function getAllTricks(): array;
    public function createTrick(Trick $trick): void;
    // public function updateTrick(Trick $trick): void;
    public function deleteTrick(Trick $trick): void;
    // public function handleCommentForm(Comment $comment, FormInterface $form): void;
    public function getTrick(string $slug): Trick;
}
