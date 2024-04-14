<?php

namespace App\Repository;

use App\Entity\IncidenciasSublineas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IncidenciasSublineas>
 *
 * @method IncidenciasSublineas|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncidenciasSublineas|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncidenciasSublineas[]    findAll()
 * @method IncidenciasSublineas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncidenciasSublineasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncidenciasSublineas::class);
    }

    //    /**
    //     * @return IncidenciasSublineas[] Returns an array of IncidenciasSublineas objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?IncidenciasSublineas
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
