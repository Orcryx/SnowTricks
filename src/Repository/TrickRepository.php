<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Trick>
 */
class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    public function findPaginatedTricks(int $page, int $limit = 5): Paginator
    {
        $query = $this->createQueryBuilder('t')
            ->orderBy('t.createAt', 'DESC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->setHint(Paginator::HINT_ENABLE_DISTINCT, false);

        return new Paginator($query);
    }

    public function getTotalTricks(): int
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('COUNT(t.id)')
            ->from(Trick::class, 't')
            ->getQuery()
            ->getSingleScalarResult();
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

    // public function updateAssociations(Trick $trick, \DateTime $currentDate): void
    // {
    //     foreach ($trick->getPicture() as $picture) {
    //         if ($picture->getCreateAt() === null) {
    //             $picture->setCreateAt($currentDate); // Définit une date de création si elle est absente
    //         }
    //         $picture->setUpdateAt($currentDate); // Met à jour la date de modification
    //     }

    //     foreach ($trick->getVideo() as $video) {
    //         if ($video->getCreateAt() === null) {
    //             $video->setCreateAt($currentDate); // Définit une date de création si elle est absente
    //         }
    //         $video->setUpdateAt($currentDate); // Met à jour la date de modification
    //     }
    // }

    public function updateAssociations(Trick $trick, \DateTime $currentDate): void
    {
        // Vérification et mise à jour des images
        foreach ($trick->getPicture() as $picture) {
            if ($picture->getCreateAt() === null) {
                $picture->setCreateAt($currentDate);
            }
            $picture->setUpdateAt($currentDate);

            // S'assurer que l'image est bien liée au Trick
            if ($picture->getTrick() === null) {
                $picture->setTrick($trick);
            }
        }

        // Vérification et mise à jour des vidéos
        foreach ($trick->getVideo() as $video) {
            if ($video->getCreateAt() === null) {
                $video->setCreateAt($currentDate);
            }
            $video->setUpdateAt($currentDate);

            // S'assurer que la vidéo est bien liée au Trick
            if ($video->getTrick() === null) {
                $video->setTrick($trick);
            }
        }
    }
}
