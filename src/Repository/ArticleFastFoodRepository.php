<?php

namespace App\Repository;

use App\Entity\ArticleFastFood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleFastFood|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleFastFood|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleFastFood[]    findAll()
 * @method ArticleFastFood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleFastFoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleFastFood::class);
    }

    // /**
    //  * @return ArticleFastFood[] Returns an array of ArticleFastFood objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleFastFood
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
