<?php

namespace App\Repository;

use App\Entity\Horario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Horario>
 *
 * @method Horario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Horario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Horario[]    findAll()
 * @method Horario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorarioRepository extends ServiceEntityRepository
{
    private $em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityM )
    {
        parent::__construct($registry, Horario::class);
        $this->em = $entityM;
    }

    //    /**
    //     * @return Horario[] Returns an array of Horario objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('h.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Horario
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findHorariosByParada($idParada)
    {
     $query = $this->em->createQuery("SELECT ho.hora, ho.tipo FROM App\Entity\Horario ho JOIN ho.sublineasParadasHorarios sub JOIN sub.parada pa WHERE pa.id = ?1");
     $query->setParameter(1, $idParada);
     return $query->getResult();
    }

}
