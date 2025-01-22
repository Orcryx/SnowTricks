<?php

namespace App\Manager;

use App\Entity\Trick;

interface TrickManagerInterface
{
    /**
     * Récupère tous les tricks.
     *
     * @return Trick[]
     */
    public function getAllTricks(): array;
    public function createTrick(Trick $trick): bool;
    public function updateTrick(Trick $trick): bool;
    public function deleteTrick(Trick $trick): void;
    public function getTrick(string $slug): ?Trick;
}
