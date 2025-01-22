<?php

namespace App\Manager;

use App\Entity\Trick;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface TrickManagerInterface
{
    /**
     * Récupère tous les tricks.
     *
     * @return Trick[]
     */
    public function getAllTricks(): array;
    // public function createTrick(Trick $trick): void;
    public function createTrick(Trick $trick): bool;
    // public function updateTrick(Trick $trick): void;
    public function deleteTrick(Trick $trick): void;
    // public function handleCommentForm(Comment $comment, FormInterface $form): void;
    public function getTrick(string $slug): ?Trick;
}
