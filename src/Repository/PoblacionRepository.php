<?php

namespace App\Repository;

use App\Entity\Poblacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Poblacion>
 *
 * @method Poblacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poblacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poblacion[]    findAll()
 * @method Poblacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoblacionRepository extends ServiceEntityRepository
{
    private $em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityM)
    {
        parent::__construct($registry, Poblacion::class);
        $this->em = $entityM;
    }

    //    /**
    //     * @return Poblacion[] Returns an array of Poblacion objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Poblacion
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

}
