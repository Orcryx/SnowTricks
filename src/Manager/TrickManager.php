<?php

namespace App\Manager;

use App\Entity\Trick;
use App\Repository\TrickRepository;


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

    // public function createTrick(Trick $trick): void
    // {
    //     $currentDate = new \DateTime();
    //     $slug = $trick->generateSlug();

    //     if ($this->trickRepository->findBySlug($slug)) {
    //         throw new \InvalidArgumentException("Slug déjà existant");
    //     }
    //     $trick->setSlug($slug);
    //     foreach ($trick->getPicture() as $picture) {
    //         $picture->setCreateAt($currentDate);
    //         $picture->setUpdateAt($currentDate);
    //     }

    //     foreach ($trick->getVideo() as $video) {
    //         $video->setCreateAt($currentDate);
    //         $video->setUpdateAt($currentDate);
    //     }
    //     $this->trickRepository->save($trick);
    // }

    public function createTrick(Trick $trick): bool
    {
        $currentDate = new \DateTime();
        $slug = $trick->generateSlug();

        if ($this->trickRepository->slugExists($slug)) {
            return false; // Indique que le slug existe déjà
        }

        $trick->setSlug($slug);

        foreach ($trick->getPicture() as $picture) {
            $picture->setCreateAt($currentDate);
            $picture->setUpdateAt($currentDate);
        }

        foreach ($trick->getVideo() as $video) {
            $video->setCreateAt($currentDate);
            $video->setUpdateAt($currentDate);
        }

        $this->trickRepository->save($trick);

        return true; // Indique que la création a réussi
    }


    public function deleteTrick(Trick $trick): void
    {
        $this->trickRepository->save($trick);
    }


    public function getTrick(string $slug): Trick
    {
        return $this->trickRepository->findOneBy(['slug' => $slug]);
    }
}
