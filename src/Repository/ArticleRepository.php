<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\ArticleContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findAllTranslated()
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.translations', 'at')
            ->addSelect('at')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findOneTranslated(int $id)
    {
        return $this->createQueryBuilder('a')
            ->join('a.articleContents', 'ac')
            ->leftJoin('a.translations', 'at')
            ->leftJoin('ac.translations', 'act')
            ->addSelect('ac, at, act')
            ->andWhere('a.id = :id')
            ->setParameters(['id' => $id])
            ->orderBy('ac.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
