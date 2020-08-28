<?php

namespace App\Repository;

use App\Entity\GithubContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GithubContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method GithubContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method GithubContent[]    findAll()
 * @method GithubContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GithubContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GithubContent::class);
    }

    // /**
    //  * @return GithubContent[] Returns an array of GithubContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GithubContent
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
