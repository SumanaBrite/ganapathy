<?php

namespace App\Repository;

use App\Entity\UniteFastFood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UniteFastFood|null find($id, $lockMode = null, $lockVersion = null)
 * @method UniteFastFood|null findOneBy(array $criteria, array $orderBy = null)
 * @method UniteFastFood[]    findAll()
 * @method UniteFastFood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UniteFastFoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UniteFastFood::class);
    }

    // /**
    //  * @return UniteFastFood[] Returns an array of UniteFastFood objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UniteFastFood
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
