<?php

namespace App\Repository;

use App\Entity\CategorieFastFood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieFastFood|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieFastFood|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieFastFood[]    findAll()
 * @method CategorieFastFood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieFastFoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieFastFood::class);
    }

    // /**
    //  * @return CategorieFastFood[] Returns an array of CategorieFastFood objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieFastFood
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
