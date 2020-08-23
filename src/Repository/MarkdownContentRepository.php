<?php

namespace App\Repository;

use App\Entity\MarkdownContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MarkdownContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarkdownContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarkdownContent[]    findAll()
 * @method MarkdownContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkdownContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarkdownContent::class);
    }

    // /**
    //  * @return MarkdownContent[] Returns an array of MarkdownContent objects
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
    public function findOneBySomeField($value): ?MarkdownContent
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
