<?php

namespace App\Repository;

use App\Entity\RelatedSocialNetwork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RelatedSocialNetwork>
 *
 * @method RelatedSocialNetwork|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelatedSocialNetwork|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelatedSocialNetwork[]    findAll()
 * @method RelatedSocialNetwork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelatedSocialNetworkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelatedSocialNetwork::class);
    }

    public function add(RelatedSocialNetwork $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RelatedSocialNetwork $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RelatedSocialNetwork[] Returns an array of RelatedSocialNetwork objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RelatedSocialNetwork
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
