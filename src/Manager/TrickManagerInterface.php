<?php

namespace App\Manager;

use App\Entity\Trick;
use Doctrine\ORM\Tools\Pagination\Paginator;

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
    public function getPaginatedTricks(int $page, int $limit = 5): Paginator;
    public function getNumberTricks(): int;
}
