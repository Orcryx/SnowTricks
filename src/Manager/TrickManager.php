<?php

namespace App\Manager;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Component\Form\FormInterface;

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

    public function createTrick(Trick $trick): void
    {
        $currentDate = new \DateTime();

        $trick->setCreateAt(new \DateTime());
        $trick->setUpdateAt(new \DateTime());
        $trick->generateSlug();
        foreach ($trick->getPicture() as $picture) {
            $picture->setCreateAt($currentDate);
            $picture->setUpdateAt($currentDate);
        }

        foreach ($trick->getVideo() as $video) {
            $video->setCreateAt($currentDate);
            $video->setUpdateAt($currentDate);
        }
        $this->trickRepository->save($trick);
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
