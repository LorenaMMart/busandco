<?php

namespace App\Repository;

use App\Entity\Linea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Linea>
 *
 * @method Linea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Linea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Linea[]    findAll()
 * @method Linea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineaRepository extends ServiceEntityRepository
{
    private $em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityM)
    {
        parent::__construct($registry, Linea::class);
        $this->em = $entityM;
    }

    //    /**
    //     * @return Linea[] Returns an array of Linea objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Linea
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findLineasByParada($lineaId,$paradaId)
    {
     $query = $this->em->createQuery("SELECT DISTINCT li.nombre, li.id FROM App\Entity\Linea li JOIN li.sublineas sl JOIN sl.sublineasParadasHorarios sub JOIN sub.parada p WHERE p.id = ?1 AND li.id <> ?2");
     $query->setParameter(1, $paradaId);
     $query->setParameter(2, $lineaId);
     return $query->getResult();
    }

    public function findLineaByIncidencia($idIncidencia)
    {
     $query = $this->em->createQuery("SELECT li.id, li.nombre FROM App\Entity\Linea li JOIN li.sublineas sl JOIN sl.incidenciasSublineas insl JOIN insl.incidencia inc WHERE inc.id = ?1 and inc.estado = ?2");
     $query->setParameter(1, $idIncidencia);
     $query->setParameter(2, 1);
     return $query->getResult();
    }
}
