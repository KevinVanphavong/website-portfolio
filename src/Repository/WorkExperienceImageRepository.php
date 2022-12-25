<?php

namespace App\Repository;

use App\Entity\WorkExperienceImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WorkExperienceImage>
 *
 * @method WorkExperienceImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkExperienceImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkExperienceImage[]    findAll()
 * @method WorkExperienceImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkExperienceImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkExperienceImage::class);
    }

    public function add(WorkExperienceImage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(WorkExperienceImage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return WorkExperienceImage[] Returns an array of WorkExperienceImage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WorkExperienceImage
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
