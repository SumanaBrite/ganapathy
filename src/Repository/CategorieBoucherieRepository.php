<?php

namespace App\Repository;

use App\Entity\CategorieBoucherie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieBoucherie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieBoucherie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieBoucherie[]    findAll()
 * @method CategorieBoucherie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieBoucherieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieBoucherie::class);
    }

    // /**
    //  * @return CategorieBoucherie[] Returns an array of CategorieBoucherie objects
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
    public function findOneBySomeField($value): ?CategorieBoucherie
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
