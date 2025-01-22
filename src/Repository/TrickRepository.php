<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trick>
 */
class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    public function save(Trick $trick, bool $flush = true): void
    {
        $this->getEntityManager()->persist($trick);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Trick $trick, bool $flush = true): void
    {
        $this->getEntityManager()->remove($trick);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBySlug(string $slug): ?Trick
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    public function slugExists(string $slug): bool
    {
        return (bool) $this->findOneBy(['slug' => $slug]);
    }

    public function updateAssociations(Trick $trick, \DateTime $currentDate): void
    {
        foreach ($trick->getPicture() as $picture) {
            if ($picture->getCreateAt() === null) {
                $picture->setCreateAt($currentDate); // Définit une date de création si elle est absente
            }
            $picture->setUpdateAt($currentDate); // Met à jour la date de modification
        }

        foreach ($trick->getVideo() as $video) {
            if ($video->getCreateAt() === null) {
                $video->setCreateAt($currentDate); // Définit une date de création si elle est absente
            }
            $video->setUpdateAt($currentDate); // Met à jour la date de modification
        }
    }
}
