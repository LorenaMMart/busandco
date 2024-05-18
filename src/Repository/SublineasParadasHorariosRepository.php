<?php

namespace App\Repository;

use App\Entity\SublineasParadasHorarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<SublineasParadasHorarios>
 *
 * @method SublineasParadasHorarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method SublineasParadasHorarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method SublineasParadasHorarios[]    findAll()
 * @method SublineasParadasHorarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SublineasParadasHorariosRepository extends ServiceEntityRepository
{
    private $em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityM)
    {
        parent::__construct($registry, SublineasParadasHorarios::class);
        $this->em = $entityM;
    }

    //    /**
    //     * @return SublineasParadasHorarios[] Returns an array of SublineasParadasHorarios objects
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

    //    public function findOneBySomeField($value): ?SublineasParadasHorarios
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findDireccionesBySublinea($sublineaId)
    {
     $query = $this->em->createQuery("SELECT DISTINCT sub.direccion FROM App\Entity\SublineasParadasHorarios sub JOIN sub.sublinea sl WHERE sl.id = ?1");
     $query->setParameter(1, $sublineaId);
     return $query->getResult();
    }

}
