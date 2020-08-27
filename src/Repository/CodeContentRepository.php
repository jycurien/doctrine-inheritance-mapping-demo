<?php

namespace App\Repository;

use App\Entity\CodeContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CodeContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeContent[]    findAll()
 * @method CodeContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeContent::class);
    }

    // /**
    //  * @return CodeContent[] Returns an array of CodeContent objects
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
    public function findOneBySomeField($value): ?CodeContent
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
