<?php

namespace App\Repository;

use App\Entity\ImageContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageContent[]    findAll()
 * @method ImageContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageContent::class);
    }

    // /**
    //  * @return ImageContent[] Returns an array of ImageContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageContent
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
