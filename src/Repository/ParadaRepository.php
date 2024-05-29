<?php

namespace App\Repository;

use App\Entity\Parada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Parada>
 *
 * @method Parada|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parada|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parada[]    findAll()
 * @method Parada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParadaRepository extends ServiceEntityRepository
{
    private $em;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityM)
    {
        parent::__construct($registry, Parada::class);
        $this->em = $entityM;
    }

    //    /**
    //     * @return Parada[] Returns an array of Parada objects
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

    //    public function findOneBySomeField($value): ?Parada
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findParadasBySublinea($sublineaId,$direccion)
    {
     $query = $this->em->createQuery("SELECT DISTINCT pa FROM App\Entity\Parada pa JOIN pa.sublineasParadasHorarios sub JOIN sub.sublinea sl WHERE sl.id = ?1 AND sub.direccion =?2");
     $query->setParameter(1, $sublineaId);
     $query->setParameter(2, $direccion);
     return $query->getResult();
    }

    public function findCoordenadasbyParada($idParada)
    {
     $query = $this->em->createQuery("SELECT DISTINCT pa.latitud, pa.longitud FROM App\Entity\Parada pa WHERE pa.id = ?1");
     $query->setParameter(1, $idParada);
     return $query->getResult();
    }   
}
