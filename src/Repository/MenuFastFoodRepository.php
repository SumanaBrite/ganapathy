<?php

namespace App\Repository;

use App\Entity\MenuFastFood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MenuFastFood|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuFastFood|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuFastFood[]    findAll()
 * @method MenuFastFood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuFastFoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuFastFood::class);
    }

    // /**
    //  * @return MenuFastFood[] Returns an array of MenuFastFood objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MenuFastFood
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
