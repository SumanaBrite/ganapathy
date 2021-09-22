<?php

namespace App\Repository;

use App\Entity\ArticleFastFoodMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleFastFoodMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleFastFoodMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleFastFoodMenu[]    findAll()
 * @method ArticleFastFoodMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleFastFoodMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleFastFoodMenu::class);
    }

    // /**
    //  * @return ArticleFastFoodMenu[] Returns an array of ArticleFastFoodMenu objects
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
    public function findOneBySomeField($value): ?ArticleFastFoodMenu
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
