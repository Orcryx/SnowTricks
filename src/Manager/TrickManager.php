<?php

namespace App\Manager;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TrickManager implements TrickManagerInterface
{

    public function __construct(private readonly TrickRepository $trickRepository) {}

    /**
     * Récupère tous les tricks.
     *
     * @return Trick[]
     */
    public function getAllTricks(): array
    {
        return $this->trickRepository->findAll();
    }

    public function createTrick(Trick $trick): bool
    {
        $currentDate = new \DateTime();
        $slug = $trick->generateSlug();

        // Appelle le repository pour gérer les dates dans les associations
        $this->trickRepository->updateAssociations($trick, $currentDate);

        if ($this->trickRepository->slugExists($slug)) {
            return false;
        }

        $trick->setSlug($slug);
        $trick->setCreateAt($currentDate);
        $trick->setUpdateAt($currentDate);

        $this->trickRepository->save($trick);

        return true;
    }

    public function deleteTrick(Trick $trick): void
    {
        $this->trickRepository->remove($trick);
    }

    public function getTrick(string $slug): Trick
    {
        return $this->trickRepository->findOneBy(['slug' => $slug]);
    }

    public function updateTrick(Trick $trick): bool
    {
        $currentDate = new \DateTime();

        // Appelle le repository pour gérer les dates dans les associations
        $this->trickRepository->updateAssociations($trick, $currentDate);

        $slug = $trick->generateSlug();
        if ($this->trickRepository->slugExists($slug) && $slug !== $trick->getSlug()) {
            return false;
        }
        $trick->setSlug($slug);

        $trick->setUpdateAt($currentDate);

        $this->trickRepository->save($trick);
        dump("Après sauvegarde :", $trick->getPicture(), $trick->getVideo());
        return true;
    }

    public function getPaginatedTricks(int $page, int $limit = 5): Paginator
    {
        return $this->trickRepository->findPaginatedTricks($page, $limit);
    }

    public function getNumberTricks(): int
    {
        return $this->trickRepository->getTotalTricks();
    }
}
