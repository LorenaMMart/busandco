<?php

namespace App\Repository;

use App\Entity\Sublinea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sublinea>
 *
 * @method Sublinea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sublinea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sublinea[]    findAll()
 * @method Sublinea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SublineaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sublinea::class);
    }

    //    /**
    //     * @return Sublinea[] Returns an array of Sublinea objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Sublinea
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

   
}
