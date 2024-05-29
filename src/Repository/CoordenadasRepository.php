<?php

namespace App\Repository;

use App\Entity\Coordenadas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Coordenadas>
 *
 * @method Coordenadas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coordenadas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coordenadas[]    findAll()
 * @method Coordenadas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordenadasRepository extends ServiceEntityRepository
{
    private $em;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityM)
    {
        parent::__construct($registry, Coordenadas::class);
        $this->em = $entityM;
    }

    //    /**
    //     * @return Coordenadas[] Returns an array of Coordenadas objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Coordenadas
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findCoordenadasBySublinea($sublineaId)
    {
     $query = $this->em->createQuery("SELECT cor.latitud, cor.longitud FROM App\Entity\Coordenadas cor JOIN cor.sublinea sl WHERE sl.id = ?1");
     $query->setParameter(1, $sublineaId);
     return $query->getResult();
    }

}
