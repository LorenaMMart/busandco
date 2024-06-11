<?php

namespace App\Repository;

use App\Entity\Sublinea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

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
    private $em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityM)
    {
        parent::__construct($registry, Sublinea::class);
        $this->em = $entityM;
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

    public function findSublineasActivas($idSublinea)
    {
     $query = $this->em->createQuery("SELECT DISTINCT sl FROM App\Entity\Sublinea sl  
                                    JOIN sl.linea li 
                                    WHERE sl.id =?1 and li.activa = true");
     $query->setParameter(1, $idSublinea);
     return $query->getResult();
    }

    public function findSublineasByParadas($pOrigen, $pDestino)
    {
     $query = $this->em->createQuery("SELECT DISTINCT sl FROM App\Entity\Sublinea sl 
                                    JOIN sl.sublineasParadasHorarios sub 
                                    JOIN sub.parada pa 
                                    JOIN sl.linea li 
                                    WHERE (pa.id = ?1 or pa.id = ?2) and li.activa = true");
     $query->setParameter(1, $pOrigen);
     $query->setParameter(2, $pDestino);
     return $query->getResult();
    }

   
}
